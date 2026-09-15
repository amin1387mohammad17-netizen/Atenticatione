<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// مسیرهای احراز هویت
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// مسیرهای پنل مدیریت
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::middleware('permission:manage-users')->group(function () {
        Route::resource('admins', AdminController::class);
    });

    Route::middleware('permission:manage-products')->group(function () {
        Route::resource('products', ProductController::class);
    });

    Route::middleware('permission:manage-posts')->group(function () {
        Route::resource('posts', PostController::class);
    });
});
