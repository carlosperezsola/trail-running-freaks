<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trademark;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Purchase;
use Illuminate\Support\Carbon;

class AdminUserController extends Controller
{
    public function dashboard()
    {
        $todaysPurchase = Purchase::whereDate('created_at', Carbon::today())->count();
        $todaysPendingPurchase = Purchase::whereDate('created_at', Carbon::today())
            ->where('purchase_status', 'pending')->count();
        $totalPurchases = Purchase::count();
        $totalPendingPurchases = Purchase::where('purchase_status', 'pending')->count();
        $totalCanceledPurchases = Purchase::where('purchase_status', 'canceled')->count();
        $totalCompletePurchases = Purchase::where('purchase_status', 'delivered')->count();
        $todaysEarnings = Purchase::where('purchase_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('sub_total');
        $monthEarnings = Purchase::where('purchase_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('sub_total');
        $yearEarnings = Purchase::where('purchase_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('sub_total');
        $totalTrademarks = Trademark::count();
        $totalCategories = Category::count();
        $totalSubscriber = NewsletterSubscriber::count();

        return view('admin_user.dashboard', compact(
            'todaysPurchase',
            'todaysPendingPurchase',
            'totalPurchases',
            'totalPendingPurchases',
            'totalCanceledPurchases',
            'totalCompletePurchases',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'totalTrademarks',
            'totalCategories',
            'totalSubscriber'
        ));
    }

    public function login()
    {
        return view('admin_user.auth.login');
    }
}
