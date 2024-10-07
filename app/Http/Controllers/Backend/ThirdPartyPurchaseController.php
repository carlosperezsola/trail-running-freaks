<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ThirdPartyPurchaseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\ThirdParty;
use Illuminate\Http\Request;

class ThirdPartyPurchaseController extends Controller
{
    public function index(ThirdPartyPurchaseDataTable $dataTable)
    {
        return $dataTable->render('third_party_user.purchase.index');
    }

    public function show(string $id)
    {
        $purchase = Purchase::with(['purchaseProducts'])->findOrFail($id);
        return view('third_party_user.purchase.show', compact('purchase'));
    }

    public function purchaseStatus(Request $request, string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->purchase_status = $request->status;
        $purchase->save();

        toastr('Status Updated Successfully!', 'success', 'Success');

        return redirect()->back();
    }
}
