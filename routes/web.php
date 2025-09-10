<?php
// routes/web.php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MakassarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

// Route yang perlu dicek akses
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Route::get('/home', function () {
//     return view('pages.utama.index');
// })->name('home');

// Route::prefix('translator')->name('translator.')->group(function () {
//     Route::get('/', [TranslationController::class, 'index'])->name('index');
//     Route::get('/translate', [TranslationController::class, 'translate'])->name('translate');
//     Route::get('/history', [TranslationController::class, 'history'])->name('history');
// });

Route::get('/translate', [TranslationController::class, 'index'])->name('translate.index');

// Route untuk API translation (POST)
Route::post('/translate', [TranslationController::class, 'translate'])->name('translate.process');

// Route untuk history translations
Route::get('/', [HistoryController::class, 'index'])->name('home');
Route::get('/translate/history', [HistoryController::class, 'history'])->name('translate.history');

Route::get('/tokoh', [MakassarController::class, 'showPahlawan'])->name('tokoh');
Route::get('/makanan', [MakassarController::class, 'showMakanan'])->name('makanan');
