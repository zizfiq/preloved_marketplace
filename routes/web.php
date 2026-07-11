<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Produk
|--------------------------------------------------------------------------
*/

Route::resource('products', ProductController::class);

/*
|--------------------------------------------------------------------------
| Dashboard User
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Payment
    |--------------------------------------------------------------------------
    */

    Route::get('/payment/{product}', [PaymentController::class, 'create'])
        ->name('payment.create');

    Route::post('/payment', [PaymentController::class, 'store'])
        ->name('payment.store');

    Route::get('/payment-history', [PaymentController::class, 'history'])
        ->name('payment.history');

    Route::get('/payment/{payment}/detail', [PaymentController::class, 'show'])
        ->name('payment.show');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Daftar Pembayaran
    Route::get('/payment-admin', [PaymentController::class, 'admin'])
        ->name('payment.admin');

    // Verifikasi Pembayaran
    Route::put('/payment/{id}/verify', [PaymentController::class, 'verify'])
        ->name('payment.verify');

    // Tolak Pembayaran
    Route::put('/payment/{id}/reject', [PaymentController::class, 'reject'])
        ->name('payment.reject');

});

/*
|--------------------------------------------------------------------------
| Auth Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';