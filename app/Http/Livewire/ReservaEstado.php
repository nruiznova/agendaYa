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
        \Log::info("✅ mount recibido: ID $reservaId, estado $estado");

        $this->reservaId = $reservaId;
        $this->estado = $estado;
    }

    public function updatedEstado()
    {
        \Log::info("✨ updatedEstado ejecutado con valor: " . $this->estado);

        $reserva = Reserva::find($this->reservaId);
        if ($reserva) {
            $reserva->estado = $this->estado;
            $reserva->save();

            session()->flash('success', 'Estado actualizado');
        } else {
            \Log::error('❌ Reserva no encontrada: ' . $this->reservaId);
        }
    }

    public function render()
    {
        return view('livewire.reserva-estado');
    }
}
