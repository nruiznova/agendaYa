<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fecha' => 'required|date',
            'hora' => 'required',
            'comentario' => 'nullable|string|max:500',
        ]);

        Reserva::create($request->all());

        return redirect()->route('reservas.form')->with('success', 'Tu reserva fue enviada con éxito.');
    }

    public function index()
    {
        $reservas = \App\Models\Reserva::orderBy('fecha', 'asc')->orderBy('hora')->get();

        return view('admin.reservas', compact('reservas'));
    }

    public function cambiarEstado(\App\Models\Reserva $reserva, \Illuminate\Http\Request $request)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $reserva->estado = $request->estado;
        $reserva->save();

        return redirect()->route('admin.reservas')->with('success', 'Estado actualizado correctamente.');
    }

}
