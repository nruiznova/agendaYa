<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se definen las rutas de la aplicación AgendaYa.
|
*/

// Ruta del panel de reservas (protegida con login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reservas', [ReservaController::class, 'index'])->name('admin.reservas');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::patch('/admin/reservas/{reserva}/estado', [ReservaController::class, 'cambiarEstado'])
    ->name('admin.reservas.estado');
});

// Ruta para mostrar la landing con el formulario de reservas
Route::get('/', function () {
    return view('welcome');
})->name('reservas.form');

// Ruta para guardar la reserva (desde el formulario)
Route::post('/reservar', [ReservaController::class, 'store'])->name('reservas.store');
