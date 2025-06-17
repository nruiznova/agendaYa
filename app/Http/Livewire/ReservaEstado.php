<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva;

class ReservaEstado extends Component
{
    public $reservaId;
    public $estado;

    public function mount($reserva)
    {
        $this->reservaId = $reserva['id'];
        $this->estado = $reserva['estado'];
    }

    public function updatedEstado()
    {
        \Log::info("Actualizando reserva: {$this->reservaId} a estado {$this->estado}");

        $reserva = Reserva::find($this->reservaId);

        if ($reserva) {
            $reserva->estado = $this->estado;
            $reserva->save();
        }
    }

    public function render()
    {
        return view('livewire.reserva-estado');
    }
}
