<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountDown;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $countDownDate = CountDown::first();
        return view('frontend.home.home',
            compact(
                'sliders',
                'countDownDate'
            ));
    }
}
