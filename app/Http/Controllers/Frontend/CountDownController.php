<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountDown;
use App\Models\CountDownItem;

class CountDownController extends Controller
{
    public function index()
    {
        $countDownDate = CountDown::first();
        //$countDownItems = CountDownItem::where('status', 1)->orderBy('id', 'ASC')->pluck('product_id')->toArray();
        $countDownItems = CountDownItem::where('status', 1)->orderBy('id', 'ASC')->paginate(20);
        return view('frontend.pages.count-down', compact('countDownDate', 'countDownItems'));
    }
}
