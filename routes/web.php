<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\CountDownController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\UserPurchaseController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductTrackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::localized(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';

    Route::get('count-down', [CountDownController::class, 'index'])->name('count-down');

    /** Product route */
    Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.index');
    Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
    Route::get('change-product-list-view', [FrontendProductController::class, 'chageListView'])->name('change-product-list-view');

    /** Cart routes */
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
    Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
    Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
    Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
    Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
    Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
    Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
    Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');

    /** Newsletter routes */
    Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequset'])->name('newsletter-request');
    Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVerify'])->name('newsletter-verify');

    /** Who we are page route */
    Route::get('who-we-are', [PageController::class, 'whoWeAre'])->name('who-we-are');

    /** Terms & conditions page route */
    Route::get('terms-and-conditions', [PageController::class, 'termsAndCondition'])->name('terms-and-conditions');

    /** Contact route */
    Route::get('contact', [PageController::class, 'contact'])->name('contact');
    Route::post('contact', [PageController::class, 'manageContactForm'])->name('manage-contact-form');

    /** Product track route */
    Route::get('product-tracking', [ProductTrackController::class, 'index'])->name('product-tracking.index');

    /** Product routes */
    Route::get('show-product-modal/{id}', [HomeController::class, 'ShowProductModal'])->name('show-product-modal');

    /** Third party page routes */
    Route::get('thirdParty', [HomeController::class, 'thirdPartyPage'])->name('thirdParty.index');
    Route::get('thirdParty-product/{id}', [HomeController::class, 'thirdPartyProductsPage'])->name('thirdParty.products');

    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        //User profile
        Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
        //User profile update
        Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
        //User profile update password
        Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

        /** User address route */
        Route::resource('address', UserAddressController::class);

        /** Purchase routes */
        Route::get('purchases', [UserPurchaseController::class, 'index'])->name('purchases.index');
        Route::get('purchases/show/{id}', [UserPurchaseController::class, 'show'])->name('purchases.show');

        /** Checkout routes */
        Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
        Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
        Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

        /** Payment routes */
        Route::get('payment', [PaymentController::class, 'index'])->name('payment');
        Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

        /** Paypal routes */
        Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
        Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
        Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

        /** Stripe routes */
        Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    });
});
