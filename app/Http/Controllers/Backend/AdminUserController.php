<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\User;
use App\Models\thirdParty;
use Illuminate\Support\Carbon;

class AdminUserController extends Controller
{
    public function dashboard()
    {
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->count();
        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'pending')->count();
        $totalOrders = Order::count();
        $totalPendingOrders = Order::where('order_status', 'pending')->count();
        $totalCanceledOrders = Order::where('order_status', 'canceled')->count();
        $totalCompleteOrders = Order::where('order_status', 'delivered')->count();
        $todaysEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('sub_total');
        $monthEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('sub_total');
        $yearEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('sub_total');
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalSubscriber = NewsletterSubscriber::count();

        return view('admin_user.dashboard', compact(
            'todaysOrder',
            'todaysPendingOrder',
            'totalOrders',
            'totalPendingOrders',
            'totalCanceledOrders',
            'totalCompleteOrders',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'totalBrands',
            'totalCategories',
            'totalSubscriber'
        ));
    }

    public function login()
    {
        return view('admin_user.auth.login');
    }
}
