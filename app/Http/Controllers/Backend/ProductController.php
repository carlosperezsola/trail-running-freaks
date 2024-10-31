<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Trademark;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductOption;
use App\Models\SubCategory;
use App\Models\PurchaseProduct;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin_user.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $trademarks = Trademark::all();
        return view('admin_user.product.create', compact('categories', 'trademarks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Obtén la configuración de idiomas
        $locales = config('app.available_locales'); // Asegúrate de que los locales estén definidos

        // Generar las reglas de validación dinámicamente para cada idioma
        $validationRules = [
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'trademark' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],            
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status' => ['required']
        ];

        foreach ($locales as $locale) {
            $validationRules["short_description_$locale"] = ['required', 'max:600'];
            $validationRules["long_description_$locale"] = ['required'];
        }

        // Validar los datos
        $request->validate($validationRules);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'uploads/selected');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->thirdParty_id = Auth::user()->thirdParty->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->trademark_id = $request->trademark;
        $product->qty = $request->qty;

        // Asignar las descripciones largas basadas en los sufijos
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
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin_user.products.index');
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
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $trademarks = Trademark::all();
        return view('admin_user.product.edit', compact('product', 'categories', 'trademarks', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Obtén la configuración de idiomas
        $locales = config('app.available_locales'); // Asegúrate de que los locales estén definidos

        // Generar las reglas de validación dinámicamente para cada idioma
        $validationRules = [
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'trademark' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ];

        foreach ($locales as $locale) {
            $validationRules["short_description_$locale"] = ['required', 'max:600'];
            $validationRules["long_description_$locale"] = ['required'];
        }

        // Validar los datos
        $request->validate($validationRules);

        $product = Product::findOrFail($id);

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image', 'uploads/selected', $product->thumb_image);

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->trademark_id = $request->trademark;
        $product->qty = $request->qty;

        // Asignar las descripciones largas basadas en los sufijos
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
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin_user.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if (PurchaseProduct::where('product_id', $product->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This product has orders and can\'t be deleted.']);
        }

        /** Delete the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImages as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product options if exist */
        $options = ProductOption::where('product_id', $product->id)->get();
        foreach ($options as $option) {
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
     * Get all product sub categories
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
