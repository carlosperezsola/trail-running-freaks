<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $dataTable)
    {
        return $dataTable->render('admin_user.product.seller-product.index');
    }
}
