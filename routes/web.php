<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKeanggotaan\AnggotaController;
use App\Http\Controllers\DataKeanggotaan\GrupController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('data-keanggotaan')->name('data-keanggotaan.')->group(function () {
    Route::get('/grup', [GrupController::class, 'index'])->name('grup');
    Route::get('/grup/{grup}', [GrupController::class, 'show'])->name('grup.show');
    Route::post('/grup', [GrupController::class, 'store'])->name('grup.store');
    Route::put('/grup/{grup}', [GrupController::class, 'update'])->name('grup.update');
    Route::delete('/grup/{grup}', [GrupController::class, 'destroy'])->name('grup.destroy');

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
    Route::get('/anggota/{anggota}', [AnggotaController::class, 'show'])->name('anggota.show');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
});
