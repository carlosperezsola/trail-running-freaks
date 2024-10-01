<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductOptionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionItem;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductOptionDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin_user.product.product-option.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_user.product.product-option.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $option = new ProductOption();
        $option->product_id = $request->product;
        $option->name = $request->name;
        $option->status = $request->status;
        $option->save();

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin_user.products-option.index', ['product' => $request->product]);
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
        $option = ProductOption::findOrFail($id);
        return view('admin_user.product.product-option.edit', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $option = ProductOption::findOrFail($id);
        $option->name = $request->name;
        $option->status = $request->status;
        $option->save();

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('admin_user.products-option.index', ['product' => $option->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $option = ProductOption::findOrFail($id);
        $optionItemCheck = ProductOptionItem::where('product_option_id', $option->id)->count();
        if($optionItemCheck > 0){
            return response(['status' => 'error', 'message' => 'This option contain option items in it. Delete the option items before deleting the option!']);
        }
        $option->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);

    }

    public function changeStatus(Request $request)
    {
        $option = ProductOption::findOrFail($request->id);
        $option->status = $request->status == 'true' ? 1 : 0;
        $option->save();

        return response(['message' => 'Status has been updated!']);
    }
}
