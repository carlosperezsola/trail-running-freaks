<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileUserController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminUserController::class, 'dashboard'])
    ->name('dashboard');

/** Profile Routes */
Route::get('profile', [ProfileUserController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileUserController::class, 'updateUserProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileUserController::class, 'updatePassword'])->name('password.update');

/** Slider Routes */
Route::resource('slider', SliderController::class);

/** Category route */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** Sub category route */
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);