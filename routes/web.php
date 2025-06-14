<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Inventaris routes dengan grouping
Route::prefix('inventaris')->name('inventaris.')->middleware('auth')->group(function () {
    Route::view('/', 'pages.inventaris.index')->name('index');
    Route::view('/tambah', 'pages.inventaris.tambah')->name('tambah');
    Route::view('/kategori', 'pages.inventaris.kategori')->name('kategori');
    Route::view('/detail-unit', 'pages.inventaris.detail-unit')->name('detail-unit');
});

// Pesanan routes
Route::prefix('pesanan')->name('pesanan.')->middleware('auth')->group(function () {
    Route::view('/', 'pages.pesanan.index')->name('index');
});

// Pelanggan routes
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::view('/', 'pages.pelanggan.index')->name('index');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

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

require __DIR__.'/auth.php';
