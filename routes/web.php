<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriaController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/objeto', [ObjetoController::class, 'index'])->name('objetos.index');
Route::get('/objeto/create', [ObjetoController::class, 'create'])->name('objetos.create');
Route::post('/objeto', [ObjetoController::class, 'store'])->name('objetos.store');
Route::get('/objeto/{objeto}', [ObjetoController::class, 'show'])->name('objetos.show');
Route::get('/objeto/{objeto}/edit', [ObjetoController::class, 'edit'])->name('objetos.edit');
Route::put('/objeto/{objeto}', [ObjetoController::class, 'update'])->name('objetos.update');
Route::delete('/objeto/{objeto}', [ObjetoController::class, 'destroy'])->name('objetos.destroy');


Route::delete('/galerias/{galeria}', [GaleriaController::class, 'destroy'])->name('galerias.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
