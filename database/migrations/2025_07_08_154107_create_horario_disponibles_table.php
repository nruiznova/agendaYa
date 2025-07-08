<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horario_disponibles', function (Blueprint $table) {
            $table->id();
            $table->string('dia'); // Lunes, Martes, etc.
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('intervalo')->default(30); // minutos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_disponibles');
    }
};
