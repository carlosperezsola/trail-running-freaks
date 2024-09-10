<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ThirdPartyOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ThirdParty;
use Illuminate\Http\Request;

class ThirdPartyOrderController extends Controller
{
    public function index(ThirdPartyOrderDataTable $dataTable)
    {
        return $dataTable->render('third_party_user.order.index');
    }

    public function show(string $id)
    {
        $order = Order::with(['orderProducts'])->findOrFail($id);
        return view('third_party_user.order.show', compact('order'));
    }

    public function orderStatus(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->status;
        $order->save();

        toastr('Status Updated Successfully!', 'success', 'Success');

        return redirect()->back();
    }
}
