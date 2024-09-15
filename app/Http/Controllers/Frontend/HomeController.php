<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountDown;
use App\Models\CountDownItem;
use App\Models\Slider;
use App\Models\HomePageSetting;
use App\Models\Brand;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index() 
    {
        $homepage_section_banner = Banner::where('key', 'homepage_section_banner')->first();
        $homepage_section_banner = json_decode($homepage_section_banner->value);

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
                'brands',
                'homepage_section_banner',
            ));
    }
}
