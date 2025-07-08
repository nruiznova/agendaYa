<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\HorarioDisponible;

class ReservaController extends Controller
{

    public function obtenerHorasDisponibles(Request $request)
    {
        $fecha = $request->input('fecha');

        $horas = HorarioDisponible::obtenerHorasParaFecha($fecha);

        // Quitar las horas ya reservadas
        $reservadas = Reserva::where('fecha', $fecha)->pluck('hora')->toArray();

        $reservadas = array_merge(
            Reserva::where('fecha', $fecha)->pluck('hora')->toArray(),
            \App\Models\BloqueoHorario::where('fecha', $fecha)
                ->whereNotNull('hora')
                ->pluck('hora')
                ->toArray()
        );

        $bloqueoDia = \App\Models\BloqueoHorario::where('fecha', $fecha)->whereNull('hora')->exists();

        if ($bloqueoDia) {
            return response()->json([]); // Día completo bloqueado
        }


        $disponibles = array_diff($horas, $reservadas);

        return response()->json(array_values($disponibles));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|string',
        ]);

        // Hora de la reserva (combinada con la fecha)
        $inicioReserva = Carbon::createFromFormat('Y-m-d H:i', $request->fecha . ' ' . $request->hora);
        $inicioMargen = $inicioReserva->copy()->subMinutes(30);
        $finMargen = $inicioReserva->copy()->addMinutes(30);

        // Convertir fecha+hora de todas las reservas existentes y verificar cruce
        $existe = DB::table('reservas')
            ->where('fecha', $request->fecha)
            ->whereRaw("STR_TO_DATE(CONCAT(fecha, ' ', hora), '%Y-%m-%d %H:%i') BETWEEN ? AND ?", [
                $inicioMargen->format('Y-m-d H:i'),
                $finMargen->format('Y-m-d H:i'),
            ])
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['cruce' => 'Ya hay una reserva cercana a esa hora. Intenta elegir otra.'])
                ->withInput();
        }

        Reserva::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'comentario' => $request->comentario,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservas.form')->with('success', '¡Reserva enviada con éxito!');
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

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = $request->estado;
        $reserva->save();

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }

}
