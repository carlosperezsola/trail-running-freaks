<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ThirdPartyProductController;
use App\Http\Controllers\Backend\ThirdPartyProductImageGalleryController;
use App\Http\Controllers\Backend\ThirdPartyUserController;
use App\Http\Controllers\Backend\ThirdPartyUserProfileController;
use App\Http\Controllers\Backend\ThirdPartyUserShopProfileController;
use App\Http\Controllers\Backend\ThirdPartyProductOptionController;
use App\Http\Controllers\Backend\ThirdPartyProductOptionItemController;
use App\Http\Controllers\Backend\ThirdPartyPurchaseController;


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

/** Products option route */
Route::put('products-option/change-status', [ThirdPartyProductOptionController::class, 'changeStatus'])->name('products-option.change-status');
Route::resource('products-option', ThirdPartyProductOptionController::class);

/** Products option item route */
Route::get('products-option-item/{productId}/{optionId}', [ThirdPartyProductOptionItemController::class, 'index'])->name('products-option-item.index');

Route::get('products-option-item/create/{productId}/{optionId}', [ThirdPartyProductOptionItemController::class, 'create'])->name('products-option-item.create');

Route::post('products-option-item', [ThirdPartyProductOptionItemController::class, 'store'])->name('products-option-item.store');

Route::get('products-option-item-edit/{optionItemId}', [ThirdPartyProductOptionItemController::class, 'edit'])->name('products-option-item.edit');

Route::put('products-option-item-update/{optionItemId}', [ThirdPartyProductOptionItemController::class, 'update'])->name('products-option-item.update');

Route::delete('products-option-item/{optionItemId}', [ThirdPartyProductOptionItemController::class, 'destroy'])->name('products-option-item.destroy');

Route::put('products-option-item-status', [ThirdPartyProductOptionItemController::class, 'changeStatus'])->name('products-option-item.changes-status');

/** Purchases route */
Route::get('purchases', [ThirdPartyPurchaseController::class, 'index'])->name('purchases.index');
Route::get('purchases/show/{id}', [ThirdPartyPurchaseController::class, 'show'])->name('purchases.show');
Route::get('purchases/status/{id}', [ThirdPartyPurchaseController::class, 'purchaseStatus'])->name('purchases.status');