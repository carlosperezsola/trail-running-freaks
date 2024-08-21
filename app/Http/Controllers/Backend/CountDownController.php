<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\CountDownItemDataTable;
use App\Models\CountDown;
use App\Models\Product;
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
}
