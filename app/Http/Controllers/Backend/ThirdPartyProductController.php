<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ThirdPartyProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trademark;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\ImageUploadTrait;
use App\Models\ProductImageGallery;
use App\Models\ProductOption;

class ThirdPartyProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ThirdPartyProductDataTable $dataTable)
    {
        return $dataTable->render('third_party_user.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $trademarks = Trademark::all();
        return view('third_party_user.product.create', compact('categories', 'trademarks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = config('app.available_locales');

        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'trademark' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status' => ['required']
        ]);

        foreach ($locales as $locale) {
            $validationRules["short_description_$locale"] = ['required', 'max:600'];
            $validationRules["long_description_$locale"] = ['required'];
        }
        
        $request->validate($validationRules);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->thirdParty_id = Auth::user()->ThirdParty->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->trademark_id = $request->trademark;
        $product->qty = $request->qty;

        foreach ($locales as $locale) {
            $product->{"short_description_$locale"} = $request->input("short_description_$locale");
            $product->{"long_description_$locale"} = $request->input("long_description_$locale");
        }

        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('third_party_user.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        
        if($product->thirdParty_id != Auth::user()->thirdParty->id){
            abort(404);
        }

        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $trademarks = Trademark::all();

        return view('third_party_user.product.edit',
        compact(
            'product',
            'subCategories',
            'childCategories',
            'categories',
            'trademarks'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $locales = config('app.available_locales');

        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'trademark' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status' => ['required']
        ]);

        foreach ($locales as $locale) {
            $validationRules["short_description_$locale"] = ['required', 'max:600'];
            $validationRules["long_description_$locale"] = ['required'];
        }

        $request->validate($validationRules);

        $product = Product::findOrFail($id);

        if($product->thirdParty_id != Auth::user()->thirdParty->id){
            abort(404);
        }

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->thirdParty_id = Auth::user()->ThirdParty->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->trademark_id = $request->trademark;
        $product->qty = $request->qty;

        foreach ($locales as $locale) {
            $product->{"short_description_$locale"} = $request->input("short_description_$locale");
            $product->{"long_description_$locale"} = $request->input("long_description_$locale");
        }

        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = $product->is_approved;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('third_party_user.products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        if($product->thirdParty_id != Auth::user()->thirdParty->id){
            abort(404);
        }

        /** Delete the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product options if exist */
        $options = ProductOption::where('product_id', $product->id)->get();

        foreach($options as $option){
            $option->productOptionItems()->delete();
            $option->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }

    /**
     * Get all product sub categores
     */

     public function getSubCategories(Request $request)
     {
         $subCategories = SubCategory::where('category_id', $request->id)->get();

         return $subCategories;
     }

     public function getChildCategories(Request $request)
     {
         $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

         return $childCategories;
     }
}
