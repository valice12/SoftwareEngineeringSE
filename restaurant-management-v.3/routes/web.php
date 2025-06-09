<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Auth\LoginController;



// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth:staff')
    ->name('logout');

Route::middleware(['auth:staff'])->group(function () {
    // Route ke Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::redirect('/', 'dashboard');

    // Route ke ProductController
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product-detail/{id}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::delete('/product/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('product.deleteImage');

    Route::post('/test', function(Request $request) {
        dd($request->file('image'));
    });


    // Staff
    Route::prefix('staff')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/{id}', [StaffController::class, 'show'])->name('staff.show');
        Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
    });


    // Order History
    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('history.index');
        Route::delete('/{id}', [HistoryController::class, 'destroy'])->name('history.destroy');
        // Tambahkan route show jika diperlukan
        Route::get('/{id}', [HistoryController::class, 'show'])->name('history.show');
    });

    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
});

// Tambahkan group baru untuk customer
Route::prefix('customer')->middleware(['auth:customer'])->group(function () {
    // Dashboard khusus customer
    Route::get('/dashboard', [DashboardController::class, 'customerIndex'])->name('customer.dashboard');
    Route::redirect('/', '/customer/dashboard');
    
    // Produk untuk customer (view saja)
    Route::get('/products', [ProductController::class, 'customerIndex'])->name('customer.products.index');
    Route::get('/products/{id}', [ProductController::class, 'customerShow'])->name('customer.products.show');
    
    // History untuk customer
    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'customerIndex'])->name('customer.history.index');
        Route::get('/{id}', [HistoryController::class, 'customerShow'])->name('customer.history.show');
    });
});