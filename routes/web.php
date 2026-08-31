<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;


// Route yang bisa diakses ketika user BELUM login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

// Route yang bisa diakses ketika user SUDAH login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Tambahan rute Tentang Kami
    Route::get('/tentang-kami', function () {
        return view('tentang-kami');
    })->name('tentang.kami');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        
        // PERBAIKAN: Diubah dari Route::post menjadi Route::put
        Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::resource('/produk', ProdukController::class);

        // TAMBAHAN JENIS
        Route::resource('/jenis', JenisController::class);
    });

    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('/produk', ProdukController::class);
        Route::resource('/penjualan', PenjualanController::class);
        Route::resource('/itempenjualan', ItemPenjualanController::class);
    });
});
