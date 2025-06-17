<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva;

class ReservaEstado extends Component
{
    public $reservaId;
    public $estado;

    public function mount($reservaId, $estado)
    {
        $this->reservaId = $reservaId;
        $this->estado = $estado;
    }

    public function updatedEstado()
    {
        $reserva = Reserva::find($this->reservaId);
        if ($reserva) {
            $reserva->estado = $this->estado;
            $reserva->save();
            session()->flash('success', 'Estado actualizado.');
        }
    }

    public function render()
    {
        return view('livewire.reserva-estado');
    }
}
