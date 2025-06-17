<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Livewire\Livewire;
use App\Http\Livewire\ReservaEstado;
use App\Http\Livewire\Admin\ReservasTable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('reserva-estado', ReservaEstado::class);
        Livewire::component('admin.reservas-table', ReservasTable::class);
    }
}
