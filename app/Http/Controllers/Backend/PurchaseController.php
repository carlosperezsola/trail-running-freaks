<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PurchaseDataTable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PurchaseDataTable $dataTable)
    {
        return $dataTable->render('admin_user.purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('admin_user.purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->purchaseProducts()->delete();
        $purchase->transaction()->delete();
        $purchase->delete();
        
        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changePurchaseStatus(Request $request)
    {
        $purchase = Purchase::findOrFail($request->id);
        $purchase->purchase_status = $request->status;
        $purchase->save();

        return response(['status' => 'success', 'message' => 'Updated Purchase Status']);
    }

    public function changePaymentStatus(Request $request)
    {
        $paymentStatus = Purchase::findOrFail($request->id);
        $paymentStatus->payment_status = $request->status;
        $paymentStatus->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status Successfully']);
    }
}
