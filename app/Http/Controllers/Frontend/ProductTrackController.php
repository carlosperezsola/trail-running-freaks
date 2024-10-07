<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductTrackController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tracker')) {
            $purchase = Purchase::where('invoice_id', $request->tracker)->first();
            return view('frontend.pages.product-track', compact('purchase'));
        } else {
            return view('frontend.pages.product-track');
        }
    }
}
