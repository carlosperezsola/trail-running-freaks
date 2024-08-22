<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\CountDownItemDataTable;
use App\Models\CountDown;
use App\Models\Product;
use App\Models\CountDownItem;
use Illuminate\Http\Request;

class CountDownController extends Controller
{
    public function index(CountDownItemDataTable $dataTable)
    {
        $countDownDate = CountDown::first();
        $products = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        return $dataTable->render('admin_user.count-down.index', compact('countDownDate', 'products'));
    }

    public function update(Request $request)
    {
       $request->validate([
        'end_date' => ['required']
       ]);

       CountDown::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
       );

       toastr('Updated Successfully!', 'success', 'Success');

       return redirect()->back();

    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:count_down_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ],[
            'product.unique' => 'The product was already added!'
        ]);


        $countDownDate = CountDown::first();

        $countDownItem = new CountDownItem();
        $countDownItem->product_id = $request->product;
        $countDownItem->count_down_id = $countDownDate->id;
        $countDownItem->show_at_home = $request->show_at_home;
        $countDownItem->status = $request->status;
        $countDownItem->save();

        toastr('Product Added Successfully!', 'success', 'Success');

        return redirect()->back();

    }

    public function changeShowAtHomeStatus(Request $request)
    {
        $countDownItem = CountDownItem::findOrFail($request->id);
        $countDownItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $countDownItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function changeStatus(Request $request)
    {
        $countDownItem = CountDownItem::findOrFail($request->id);
        $countDownItem->status = $request->status == 'true' ? 1 : 0;
        $countDownItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destroy(string $id)
    {
        $flashSaleItem = CountDownItem::findOrFail($id);
        $flashSaleItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
