<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountDown;
use App\Models\CountDownItem;
use App\Models\Slider;
use App\Models\HomePageSetting;
use App\Models\Trademark;
use App\Models\Promo;
use App\Models\Product;
use App\Models\ThirdParty;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index() 
    {
        $homepage_section_promo = Promo::where('key', 'homepage_section_promo')->first();
        $homepage_section_promo = json_decode($homepage_section_promo->value);

        $sliders = Cache::rememberForever('sliders', function(){
            return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        });

        $countDownDate = CountDown::first();
        $countDownItems = CountDownItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $trademarks = Trademark::where('status', 1)->where('is_featured', 1)->get();
        return view('frontend.home.home',
            compact(
                'sliders',
                'countDownDate',
                'countDownItems',
                'popularCategory',
                'trademarks',
                'homepage_section_promo',
            ));
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
        $trademarks = Trademark::where(['status' => 1])->get();
        $thirdParty = thirdParty::findOrFail($id);
        return view('frontend.pages.thirdParty-product', compact('products', 'categories', 'trademarks', 'thirdParty'));
    }

    function ShowProductModal(string $id) {
        $product = Product::findOrFail($id);
 
        $content = view('frontend.layouts.modal', compact('product'))->render();
 
        return Response::make($content, 200, ['Content-Type' => 'text/html']);
     }
}
