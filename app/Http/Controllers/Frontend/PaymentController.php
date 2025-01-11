<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use App\Models\GeneralSetting;
use App\Models\PurchaseProduct;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Session::has('address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function storePurchase($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        $setting = GeneralSetting::first();

        $purchase = new Purchase();
        $purchase->invoice_id = rand(1, 999999);
        $purchase->user_id = Auth::user()->id;
        $purchase->sub_total = getCartTotal();
        $purchase->amount = getFinalPayableAmount();
        $purchase->currency_name = $setting->currency_name;
        $purchase->currency_icon = $setting->currency_icon;
        $purchase->product_qty = \Cart::content()->count();
        $purchase->payment_method = $paymentMethod;
        $purchase->payment_status = $paymentStatus;
        $purchase->purchase_address = json_encode(Session::get('address'));
        $purchase->shipping_method = json_encode(Session::get('shipping_method'));
        $purchase->purchase_status = 'pending';
        $purchase->save();

        // store purchase products
        foreach (\Cart::content() as $item) {
            $product = Product::find($item->id);
            $purchaseProduct = new PurchaseProduct();
            $purchaseProduct->purchase_id = $purchase->id;
            $purchaseProduct->product_id = $product->id;
            $purchaseProduct->thirdParty_id = $product->thirdParty_id;
            $purchaseProduct->product_name = $product->name;
            $purchaseProduct->options = json_encode($item->options->options);
            $purchaseProduct->option_total = $item->options->options_total;
            $purchaseProduct->unit_price = $item->price;
            $purchaseProduct->qty = $item->qty;
            $purchaseProduct->save();

            // update product quantity
            $updatedQty = ($product->qty - $item->qty);
            $product->qty = $updatedQty;
            $product->save();
        }

        // store transaction details
        $transaction = new Transaction();
        $transaction->purchase_id = $purchase->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->amount_real_currency = $paidAmount;
        $transaction->amount_real_currency_name = $paidCurrencyName;
        $transaction->save();
    }

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
    }

    public function paypalConfig()
    {
        $paypalSetting = PaypalSetting::first();
        $config = [
            'mode'    => $paypalSetting->mode === 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],
            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '',
            'locale'         => 'es_ES',
            'validate_ssl'   => true,
        ];
        return $config;
    }

    /** Paypal redirect */
    public function payWithPaypal()
    {
        $paypalSetting = PaypalSetting::first(); // Aseguramos que esté definida antes de usarla
        $config = $this->paypalConfig();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        // calculate payable amount depending on currency rate
        $total = getFinalPayableAmount();
        // Usamos number_format para asegurar solo dos decimales
        $payableAmount = number_format($total * $paypalSetting->currency_rate, 2, '.', '');

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableAmount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $paypalSetting = PaypalSetting::first(); // También aquí aseguramos que esté definida
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // calculate payable amount depending on currency rate
            $total = getFinalPayableAmount();
            $paidAmount = number_format($total * $paypalSetting->currency_rate, 2, '.', '');

            $this->storePurchase('paypal', 1, $response['id'], $paidAmount, $paypalSetting->currency_name);

            // clear session
            $this->clearSession();

            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr('Something went wrong try again later!', 'error', 'Error');
        return redirect()->route('user.payment');
    }

    /** Stripe Payment */
    public function payWithStripe(Request $request)
    {
        $stripeSetting = StripeSetting::first();
        $total = getFinalPayableAmount();
        // También con number_format por coherencia
        $payableAmount = number_format($total * $stripeSetting->currency_rate, 2, '.', '');

        Stripe::setApiKey($stripeSetting->secret_key);
        $response = Charge::create([
            "amount" => $payableAmount * 100,
            "currency" => $stripeSetting->currency_name,
            "source" => $request->stripe_token,
            "description" => "product purchase!"
        ]);

        if ($response->status === 'succeeded') {
            $this->storePurchase('stripe', 1, $response->id, $payableAmount, $stripeSetting->currency_name);
            // clear session
            $this->clearSession();

            return redirect()->route('user.payment.success');
        } else {
            toastr('Someting went wrong try again later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }
}