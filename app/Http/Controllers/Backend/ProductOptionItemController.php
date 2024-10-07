<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductOptionItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionItem;
use Illuminate\Http\Request;

class ProductOptionItemController extends Controller
{
    public function index(ProductOptionItemDataTable $dataTable, $productId, $optionId)
    {
        $product = Product::findOrFail($productId);
        $option = ProductOption::findOrFail($optionId);
        return $dataTable->render('admin_user.product.product-option-item.index', compact('product', 'option'));
    }

    public function create(string $productId, string $optionId)
    {
        $option = ProductOption::findOrFail($optionId);
        $product = Product::findOrFail($productId);
        return view('admin_user.product.product-option-item.create', compact('option', 'product'));
    }

    /** Store data */
    public function store(Request $request)
    {
        $request->validate([
            'option_id' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $optionItem = new ProductOptionItem();
        $optionItem->product_option_id = $request->option_id;
        $optionItem->name = $request->name;
        $optionItem->price = $request->price;
        $optionItem->is_default = $request->is_default;
        $optionItem->status = $request->status;
        $optionItem->save();

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin_user.products-option-item.index',
        ['productId' => $request->product_id, 'optionId' => $request->option_id]);
    }

    public function edit(string $optionItemId)
    {
        $optionItem = ProductOptionItem::findOrFail($optionItemId);
        return view('admin_user.product.product-option-item.edit', compact('optionItem'));
    }

    public function update(Request $request, string $optionItemId)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $optionItem = ProductOptionItem::findOrFail($optionItemId);
        $optionItem->name = $request->name;
        $optionItem->price = $request->price;
        $optionItem->is_default = $request->is_default;
        $optionItem->status = $request->status;
        $optionItem->save();

        toastr('Update Successfully!', 'success', 'success');

        return redirect()->route('admin_user.products-option-item.index',
        ['productId' => $optionItem->productOption->product_id, 'optionId' => $optionItem->product_option_id]);
    }

    public function destroy(string $optionItemId)
    {
        $optionItem = ProductOptionItem::findOrFail($optionItemId);
        $optionItem->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $optionItem = ProductOptionItem::findOrFail($request->id);
        $optionItem->status = $request->status == 'true' ? 1 : 0;
        $optionItem->save();

        return response(['message' => 'Status has been updated!']);
    }
}
