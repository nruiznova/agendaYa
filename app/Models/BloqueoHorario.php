<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueoHorario extends Model
{
    protected $table = 'bloqueo_horarios'; // Nombre de la tabla en la BD

    protected $fillable = [
        'fecha',
        'hora',
        'motivo',
    ];

    public $timestamps = true;
}

