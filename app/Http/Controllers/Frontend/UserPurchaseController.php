<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserPurchaseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Purchase;

class UserPurchaseController extends Controller
{
    public function index(UserPurchaseDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.purchase.index');
    }

    public function show(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('frontend.dashboard.purchase.show', compact('purchase'));
    }
}
