<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Livewire\Admin\HorariosDisponibles;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Livewire\Admin\Bloqueos;

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

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/', Dashboard::class)->name('admin.dashboard');
        Route::get('/reservas', [ReservaController::class, 'index'])->name('admin.reservas');        
        Route::get('/horarios', [HorarioController::class, 'index'])->name('admin.horarios');
        Route::post('/horarios', [HorarioController::class, 'store'])->name('admin.horarios.store');
        Route::delete('/horarios/{id}', [HorarioController::class, 'destroy'])->name('admin.horarios.destroy');
        Route::get('/bloqueos', Bloqueos::class)->name('admin.bloqueos');


        Route::patch('/reservas/{reserva}/estado', [ReservaController::class, 'cambiarEstado'])
            ->name('admin.reservas.estado');

        Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('admin.reservas.update');
    });

    // Ruta de dashboard tradicional
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
});

// Ruta para mostrar la landing con el formulario de reservas
Route::get('/', function () {
    return view('welcome');
})->name('reservas.form');

// Ruta para guardar la reserva (desde el formulario)
Route::post('/reservar', [ReservaController::class, 'store'])->name('reservas.store');

// horas disponibles
Route::get('/horas-disponibles', [ReservaController::class, 'obtenerHorasDisponibles']);



