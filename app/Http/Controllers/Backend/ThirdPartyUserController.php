<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ThirdPartyUserController extends Controller
{
    public function dashboard()
    {
        $todaysPurchase = Purchase::whereDate('created_at', Carbon::today())->whereHas('purchaseProducts', function ($query) {
            $query->where('thirdParty_id', Auth::user()->thirdParty->id);
        })->count();
        $todaysPendingPurchase = Purchase::whereDate('created_at', Carbon::today())
            ->where('purchase_status', 'pending')
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->count();
        $totalPurchase = Purchase::whereHas('purchaseProducts', function ($query) {
            $query->where('thirdParty_id', Auth::user()->thirdParty->id);
        })->count();
        $totalPendingPurchase = Purchase::where('purchase_status', 'pending')
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->count();
        $totalCompletePurchase = Purchase::where('purchase_status', 'delivered')
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->count();
        $totalProducts = Product::where('thirdParty_id', Auth::user()->thirdParty->id)->count();
        $todaysEarnings = Purchase::where('purchase_status', 'delivered')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->sum('sub_total');
        $monthEarnings = Purchase::where('purchase_status', 'delivered')
            ->where('payment_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->sum('sub_total');
        $yearEarnings = Purchase::where('purchase_status', 'delivered')
            ->where('payment_status', 1)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->sum('sub_total');
        $toalEarnings = Purchase::where('purchase_status', 'delivered')
            ->whereHas('purchaseProducts', function ($query) {
                $query->where('thirdParty_id', Auth::user()->thirdParty->id);
            })->sum('sub_total');

        return view('third_party_user.dashboard.dashboard', compact(
            'todaysPurchase',
            'todaysPendingPurchase',
            'totalPurchase',
            'totalPendingPurchase',
            'totalCompletePurchase',
            'totalProducts',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'toalEarnings'
        ));
    }
}
