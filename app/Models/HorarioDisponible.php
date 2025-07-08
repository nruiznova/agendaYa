<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDisponible extends Model
{
    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'intervalo'];
    
    public static function obtenerHorasParaFecha($fecha)
    {
        $diaSemana = \Carbon\Carbon::parse($fecha)->locale('es')->dayName;

        $horarios = self::where('dia', ucfirst($diaSemana))->get();

        $horasDisponibles = [];

        foreach ($horarios as $horario) {
            $inicio = \Carbon\Carbon::createFromFormat('H:i:s', $horario->hora_inicio);
            $fin = \Carbon\Carbon::createFromFormat('H:i:s', $horario->hora_fin);

            while ($inicio < $fin) {
                $horasDisponibles[] = $inicio->format('H:i');
                $inicio->addMinutes($horario->intervalo);
            }
        }

        return $horasDisponibles;
    }


}
