<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThirdPartyUserController extends Controller
{
    public function dashboard()
    {
        return view('third_party_user.dashboard');
    }
}
