<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\ProfileUserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminUserController::class, 'dashboard'])
    ->name('dashboard');

/** Profile Routes */
Route::get('profile', [ProfileUserController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileUserController::class, 'updateUserProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileUserController::class, 'updatePassword'])->name('password.update');