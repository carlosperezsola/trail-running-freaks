<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountDown;
use App\Models\CountDownItem;
use App\Models\Slider;
use App\Models\HomePageSetting;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index() 
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $countDownDate = CountDown::first();
        $countDownItems = CountDownItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        return view('frontend.home.home',
            compact(
                'sliders',
                'countDownDate',
                'countDownItems',
                'popularCategory',
                'brands'
            ));
    }
}
