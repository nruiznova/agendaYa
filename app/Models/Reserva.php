<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    // Permite asignación masiva para estos campos
    protected $fillable = ['nombre', 'fecha', 'hora', 'estado'];
    
}
