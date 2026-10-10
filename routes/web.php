<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//Raíz
//Si el usuario está logueado → dashboard.
//Si no → login. Nunca mostramos la Welcome de Laravel.

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

//Rutas autenticadas

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))
        ->name('dashboard');

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //PLACEHOLDERS — se reemplazan a medida que construimos cada módulo

    // Ventas
    Route::get('/ventas/pos', fn () => Inertia::render('Ventas/Index'))
        ->name('ventas.pos');
    Route::get('/ventas/historial', fn () => Inertia::render('Ventas/Historial'))
        ->name('ventas.historial');

    // Caja
    Route::get('/caja/corte', fn () => Inertia::render('Caja/Corte'))
        ->name('caja.corte');

    // Inventario
    Route::get('/inventario', fn () => Inertia::render('Inventario/Index'))
        ->name('inventario.index');
    Route::get('/inventario/agregar', fn () => Inertia::render('Inventario/Agregar'))
        ->name('inventario.agregar');

    // Operaciones
    Route::get('/operaciones/solicitudes', fn () => Inertia::render('Operaciones/Solicitudes'))
        ->name('operaciones.solicitudes');
    Route::get('/operaciones/transferencias', fn () => Inertia::render('Operaciones/Transferencias'))
        ->name('operaciones.transferencias');

    // Admin
    Route::get('/admin/usuarios', fn () => Inertia::render('Admin/Usuarios'))
        ->name('admin.usuarios');
    Route::get('/admin/sucursales', fn () => Inertia::render('Admin/Sucursales'))
        ->name('admin.sucursales');
    Route::get('/admin/configuracion', fn () => Inertia::render('Admin/Configuracion'))
        ->name('admin.configuracion');

    // Reportes
    Route::get('/reportes/ventas', fn () => Inertia::render('Reportes/VentasSucursal'))
        ->name('reportes.ventas');
    Route::get('/reportes/ranking', fn () => Inertia::render('Reportes/RankingVendedores'))
        ->name('reportes.ranking');
    Route::get('/reportes/auditoria', fn () => Inertia::render('Reportes/Auditoria'))
        ->name('reportes.auditoria');
});

require __DIR__.'/auth.php';