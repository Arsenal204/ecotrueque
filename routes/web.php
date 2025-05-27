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
use App\Http\Controllers\UserController;
use App\Http\Controllers\IntercambioController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\ReclamacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', CheckIfBanned::class, RoleManager::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/admin/usuarios/{user}', [AdminController::class, 'destroy'])->name('admin.usuarios.destroy');
    Route::get('/admin/usuarios/{user}/editar', [AdminController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{user}', [AdminController::class, 'update'])->name('admin.usuarios.update');
    Route::get('/admin/reclamaciones', [ReclamacionController::class, 'index'])->name('admin.reclamaciones.index');
    Route::get('/admin/reclamaciones/{reclamacion}', [ReclamacionController::class, 'show'])->name('admin.reclamaciones.show');
    Route::put('/admin/reclamaciones/{id}/resolver', [ReclamacionController::class, 'resolver'])->name('admin.reclamaciones.resolver');
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


    Route::get('/intercambios', [IntercambioController::class, 'index'])->name('intercambios.index');
    Route::get('/intercambios/create/{id_objeto}', [IntercambioController::class, 'create'])->name('intercambios.create');
    Route::post('/intercambios', [IntercambioController::class, 'store'])->name('intercambios.store');
    Route::patch('/intercambios/{id}/confirmar', [IntercambioController::class, 'confirmar'])->name('intercambios.confirmar');
    Route::patch('/intercambios/{id}/cancelar', [IntercambioController::class, 'cancelar'])->name('intercambios.cancelar');

    Route::get('/reclamaciones/crear/{intercambio}', [ReclamacionController::class, 'create'])->name('reclamaciones.create');
    Route::post('/reclamaciones', [ReclamacionController::class, 'store'])->name('reclamaciones.store');

    // Reclamaciones del usuario
    Route::get('/mis-reclamaciones', [ReclamacionController::class, 'misReclamaciones'])->name('reclamaciones.mias');
    Route::get('/mis-reclamaciones/{id}', [ReclamacionController::class, 'showUser'])->name('reclamaciones.showUser');

    Route::get('/reclamaciones', [ReclamacionController::class, 'misReclamaciones'])->name('reclamaciones.index');


    Route::post('/usuarios/{usuario}/valorar', [ValoracionController::class, 'store'])->name('valoraciones.store');


    Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
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
