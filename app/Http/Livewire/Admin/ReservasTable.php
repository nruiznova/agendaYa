<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Reserva;

class ReservasTable extends Component
{
    public $reservas;

    public function mount()
    {
        $this->reservas = Reserva::latest()->get();
    }

    protected $listeners = ['estadoActualizado' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.reservas-table');
    }
}
