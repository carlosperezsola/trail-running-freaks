<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalPurchase = Purchase::where('user_id', Auth::user()->id)->count();
        $pendingPurchase = Purchase::where('user_id', Auth::user()->id)
            ->where('purchase_status', 'pending')->count();
        $completePurchase = Purchase::where('user_id', Auth::user()->id)
            ->where('purchase_status', 'delivered')->count();

        return view('frontend.dashboard.dashboard', compact(
            'totalPurchase',
            'pendingPurchase',
            'completePurchase'
        ));
    }
}
