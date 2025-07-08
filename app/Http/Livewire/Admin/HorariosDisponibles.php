<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HorarioDisponible;
 
class HorariosDisponibles extends Component
{
    public $dia, $hora_inicio, $hora_fin, $intervalo = 30;

    protected $rules = [
        'dia' => 'required|string',
        'hora_inicio' => 'required',
        'hora_fin' => 'required|after:hora_inicio',
        'intervalo' => 'required|integer|min:5|max:120'
    ];

    public function save() 
    {
        $this->validate();

        HorarioDisponible::create([
            'dia' => $this->dia,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'intervalo' => $this->intervalo,
        ]);

        $this->reset(['dia', 'hora_inicio', 'hora_fin', 'intervalo']);

        session()->flash('success', 'Horario guardado correctamente.');
    }

    public function delete($id)
    {
        HorarioDisponible::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.horarios-disponibles', [
            'horarios' => HorarioDisponible::orderBy('dia')->get()
        ]);
    }
}
