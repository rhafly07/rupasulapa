<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\ProductTypesController;
use App\Http\Controllers\RentalUnitsController;

// Route yang perlu dicek akses
Route::middleware(['auth', 'menu.access'])->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->middleware('verified')->name('dashboard');

    // Inventaris routes
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::get('/', [InventarisController::class, 'index'])->name('index');
        // Grup untuk kategori
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/tambah', [ProductTypesController::class, 'create'])->name('create');
            Route::post('/tambah', [ProductTypesController::class, 'store'])->name('store');
        });

        // Grup untuk unit
        Route::prefix('unit')->name('unit.')->group(function () {
            Route::get('/{id}', [RentalUnitsController::class, 'index'])->name('index');
            Route::get('/{id}/tambah', [RentalUnitsController::class, 'create'])->name('create');
            Route::post('/tambah', [RentalUnitsController::class, 'store'])->name('store');
        });
    });


    // Pesanan routes
    Route::prefix('pesanan')->name('pesanan.')->group(function () {
        Route::view('/', 'pages.pesanan.index')->name('index');
        Route::view('/tambah', 'pages.pesanan.tambah')->name('tambah');
        Route::view('/detail-pesanan', 'pages.pesanan.detail-pesanan')->name('detail-pesanan');
    });

    // Pelanggan routes
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::view('/', 'pages.pelanggan.index')->name('index');
        Route::view('/tambah', 'pages.pelanggan.tambah')->name('tambah');
    });

});

// Route yang tidak perlu dicek
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('register', function () {
    Route::view('/register', 'pages.auth.register')->name('register');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__.'/auth.php';

// User Management routes (tambahan)
// Route::prefix('users')->name('users.')->middleware('auth')->group(function () {
//     Route::view('/', 'pages.users.index')->name('index');
// });

// Route::prefix('roles')->name('roles.')->middleware('auth')->group(function () {
//     Route::view('/', 'pages.roles.index')->name('index');
// });

// Route::prefix('settings')->name('settings.')->middleware('auth')->group(function () {
//     Route::view('/reports', 'pages.settings.reports')->name('reports');
// });
