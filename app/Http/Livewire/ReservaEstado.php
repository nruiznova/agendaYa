<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva;

class ReservaEstado extends Component
{
    public $reservaId;
    public $estado;

    public function mount(Reserva $reserva)
    {
        $this->reservaId = $reserva->id;
        $this->estado = $reserva->estado;
    }

    public function updatedEstado($value)
    {
        $reserva = Reserva::find($this->reservaId);
        if ($reserva) {
            $reserva->estado = $value;
            $reserva->save();
            session()->flash('success', 'Estado actualizado.');
        }
    }

    public function render()
    {
        return view('livewire.reserva-estado');
    }
}
