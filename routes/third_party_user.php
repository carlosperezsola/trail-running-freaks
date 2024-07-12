<?php

use App\Http\Controllers\Backend\ThirdPartyUserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [ThirdPartyUserController::class, 'dashboard'])
    ->name('dashboard');