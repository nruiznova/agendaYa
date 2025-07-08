<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\BloqueoHorario;

class Bloqueos extends Component
{
    public $fecha, $hora, $motivo;

    protected $rules = [
        'fecha' => 'required|date',
        'hora' => 'nullable',
        'motivo' => 'nullable|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        BloqueoHorario::create([
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'motivo' => $this->motivo,
        ]);

        $this->reset(['fecha', 'hora', 'motivo']);
        session()->flash('success', 'Bloqueo guardado correctamente.');
    }

    public function delete($id)
    {
        BloqueoHorario::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.bloqueos', [
            'bloqueos' => BloqueoHorario::orderBy('fecha')->orderBy('hora')->get()
        ]);
    }
}
