<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Trademark;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    public function productsIndex(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::with(['variants', 'category', 'productImageGalleries'])
                ->where([
                    'category_id' => $category->id,
                    'status' => 1,
                    'is_approved' => 1
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('subcategory')) {
            $category = SubCategory::where('slug', $request->subcategory)->firstOrFail();
            $products = Product::with(['variants', 'category', 'productImageGalleries'])
                ->where([
                    'sub_category_id' => $category->id,
                    'status' => 1,
                    'is_approved' => 1
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('childcategory')) {
            $category = ChildCategory::where('slug', $request->childcategory)->firstOrFail();
            $products = Product::with(['variants', 'category', 'productImageGalleries'])
                ->where([
                    'child_category_id' => $category->id,
                    'status' => 1,
                    'is_approved' => 1
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('trademark')) {
            $trademark = Trademark::where('slug', $request->trademark)->firstOrFail();
            $products = Product::with(['variants', 'category', 'productImageGalleries'])
                ->where([
                    'trademark_id' => $trademark->id,
                    'status' => 1,
                    'is_approved' => 1
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('search')) {
            $products = Product::with(['variants', 'category', 'productImageGalleries'])
                ->where(['status' => 1, 'is_approved' => 1])
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('long_description', 'like', '%' . $request->search . '%')
                        ->orWhereHas('category', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('long_description', 'like', '%' . $request->search . '%');
                        });
                })
                ->paginate(12);
        } else {
            $products = Product::with(['variants', 'category', 'productImageGalleries'])
                ->where(['status' => 1, 'is_approved' => 1])
                ->orderBy('id', 'DESC')
                ->paginate(12);
        }

        $categories = Category::where(['status' => 1])->get();
        $trademarks = Trademark::where(['status' => 1])->get();

        return view('frontend.pages.product', compact('products', 'categories', 'trademarks'));
    }

    /** Show product detail page */
    public function showProduct(string $slug)
    {
        $product = Product::with(['thirdParty', 'category', 'productImageGalleries', 'variants', 'trademark'])->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product'));
    }

    public function chageListView(Request $request)
    {
       Session::put('product_list_style', $request->style);
    }
}
