<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function dashboard()
    {
        return view('admin_user.dashboard');
    }

    public function login()
    {
        return view('admin_user.auth.login');
    }
}