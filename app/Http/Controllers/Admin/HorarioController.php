<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HorarioDisponible;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = HorarioDisponible::orderBy('dia')->get();
        return view('admin.horarios', compact('horarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'intervalo' => 'required|integer|min:5|max:120',
        ]);

        HorarioDisponible::create($data);
        return back()->with('success','Horario guardado.');
    }

    public function destroy($id)
    {
        HorarioDisponible::destroy($id);
        return back()->with('success','Horario eliminado.');
    }
}
