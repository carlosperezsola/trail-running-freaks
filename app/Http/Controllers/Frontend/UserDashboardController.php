<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalOrder = Order::where('user_id', Auth::user()->id)->count();
        $pendingOrder = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'pending')->count();
        $completeOrder = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'delivered')->count();

        return view('frontend.dashboard.dashboard', compact(
            'totalOrder',
            'pendingOrder',
            'completeOrder'
        ));
    }
}
