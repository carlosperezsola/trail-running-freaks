<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountDown;
use App\Models\CountDownItem;
use App\Models\Slider;
use App\Models\HomePageSetting;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ThirdParty;
use App\Models\Category;

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

    public function getTypeBaseProduct()
    {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['featured_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['top_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['best_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProducts;
    }

    public function thirdPartyPage()
    {
       $thirdParties = ThirdParty::where('status',1)->paginate(20);
       return view('frontend.pages.thirdParty', compact('thirdParties'));
    }

    public function thirdPartyProductsPage(string $id)
    {
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'thirdParty_id' => $id])->orderBy('id', 'DESC')->paginate(12);
        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();
        $thirdParty = thirdParty::findOrFail($id);
        return view('frontend.pages.thirdParty-product', compact('products', 'categories', 'brands', 'thirdParty'));
    }
}
