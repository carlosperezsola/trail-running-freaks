<?php

use App\Http\Controllers\Backend\AdminThirdPartyUserProfileController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileUserController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\CountDownController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SellerProductController;

Route::get('dashboard', [AdminUserController::class, 'dashboard'])
    ->name('dashboard');

/** Profile routes */
Route::get('profile', [ProfileUserController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileUserController::class, 'updateUserProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileUserController::class, 'updatePassword'])->name('password.update');

/** Slider routes */
Route::resource('slider', SliderController::class);

/** Category routes */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** Sub category routes */
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

/** Child category routes */
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

/** Brand routes */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

/** Third party profile routes */
Route::resource('third-party-profile', AdminThirdPartyUserProfileController::class);

/** Products routes */
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);

/** Products image gallery route */
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/** Products variant route */
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

/** Products variant item route */
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.changes-status');

/** Seller product routes */
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

/** Count Down Routes */
Route::get('count-down', [CountDownController::class, 'index'])->name('count-down.index');
Route::put('count-down', [CountDownController::class, 'update'])->name('count-down.update');
Route::post('count-down/add-product', [CountDownController::class, 'addProduct'])->name('count-down.add-product');
Route::put('count-down/show-at-home/status-change', [CountDownController::class, 'changeShowAtHomeStatus'])->name('count-down.show-at-home.change-status');
Route::put('count-down-status', [CountDownController::class, 'changeStatus'])->name('count-down-status');
Route::delete('count-down/{id}', [CountDownController::class, 'destroy'])->name('count-down.destroy');