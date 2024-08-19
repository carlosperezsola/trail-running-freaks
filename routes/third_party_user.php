<?php

use App\Http\Controllers\Backend\ThirdPartyProductController;
use App\Http\Controllers\Backend\ThirdPartyProductImageGalleryController;
use App\Http\Controllers\Backend\ThirdPartyUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ThirdPartyUserProfileController;
use App\Http\Controllers\Backend\ThirdPartyUserShopProfileController;
use App\Http\Controllers\Backend\ThirdPartyProductVariantController;
use App\Http\Controllers\Backend\ThirdPartyProductVariantItemController;

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
Route::get('product/get-subcategories', [ThirdPartyProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ThirdPartyProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ThirdPartyProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ThirdPartyProductController::class);

/** Products image gallery route */
Route::resource('products-image-gallery', ThirdPartyProductImageGalleryController::class);

/** Products variant route */
Route::put('products-variant/change-status', [ThirdPartyProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ThirdPartyProductVariantController::class);

/** Products variant item route */
Route::get('products-variant-item/{productId}/{variantId}', [ThirdPartyProductVariantItemController::class, 'index'])->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}', [ThirdPartyProductVariantItemController::class, 'create'])->name('products-variant-item.create');

Route::post('products-variant-item', [ThirdPartyProductVariantItemController::class, 'store'])->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}', [ThirdPartyProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}', [ThirdPartyProductVariantItemController::class, 'update'])->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}', [ThirdPartyProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

Route::put('products-variant-item-status', [ThirdPartyProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.changes-status');