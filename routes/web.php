<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriaController;
use App\Http\Middleware\RoleManager;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckIfBanned;
use App\Http\Controllers\MensajeController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', CheckIfBanned::class, RoleManager::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/admin/usuarios/{user}', [AdminController::class, 'destroy'])->name('admin.usuarios.destroy');
    Route::get('/admin/usuarios/{user}/editar', [AdminController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{user}', [AdminController::class, 'update'])->name('admin.usuarios.update');
});

Route::middleware(['auth', 'verified', CheckIfBanned::class, RoleManager::class . ':donante,receptor,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/objeto', [ObjetoController::class, 'index'])->name('objetos.index');
    Route::get('/objeto/create', [ObjetoController::class, 'create'])->name('objetos.create');
    Route::post('/objeto', [ObjetoController::class, 'store'])->name('objetos.store');
    Route::get('/objeto/{objeto}', [ObjetoController::class, 'show'])->name('objetos.show');
    Route::get('/objeto/{objeto}/edit', [ObjetoController::class, 'edit'])->name('objetos.edit');
    Route::put('/objeto/{objeto}', [ObjetoController::class, 'update'])->name('objetos.update');
    Route::delete('/objeto/{objeto}', [ObjetoController::class, 'destroy'])->name('objetos.destroy');
    Route::get('/explorar', [ObjetoController::class, 'explorar'])->name('objetos.explorar');


    Route::delete('/galerias/{galeria}', [GaleriaController::class, 'destroy'])->name('galerias.destroy');


    Route::get('/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::get('/mensajes/enviar/{receptor}', [MensajeController::class, 'create'])->name('mensajes.create');
    Route::post('/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');
    Route::get('/mensajes', [MensajeController::class, 'conversaciones'])->name('mensajes.index');
    Route::get('/mensajes/conversacion/{usuario}', [MensajeController::class, 'conversacion'])->name('mensajes.conversacion');
});

Route::get('/baneado', function () {
    return view('baneado');
})->name('baneado');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/mensaje-a-admin', [MensajeController::class, 'mensajeDesdeBaneado'])->name('mensajes.baneado');


require __DIR__ . '/auth.php';
