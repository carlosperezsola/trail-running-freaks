<?php

use App\Http\Controllers\Backend\ThirdPartyProductController;
use App\Http\Controllers\Backend\ThirdPartyUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ThirdPartyUserProfileController;
use App\Http\Controllers\Backend\ThirdPartyUserShopProfileController;

/** Third party routes  */
Route::get('dashboard', [ThirdPartyUserController::class, 'dashboard'])->name('dashboard');
//Third party user profile
Route::get('profile', [ThirdPartyUserProfileController::class, 'index'])->name('profile');
//Third party user profile update
Route::put('profile', [ThirdPartyUserProfileController::class, 'updateProfile'])->name('profile.update');
//Third party user update password
Route::post('profile', [ThirdPartyUserProfileController::class, 'updatePassword'])->name('profile.update.password');

/** Third party shop profile  */
Route::resource('shop-profile', ThirdPartyUserShopProfileController::class);

/** Product Routes */
Route::resource('products', ThirdPartyProductController::class);