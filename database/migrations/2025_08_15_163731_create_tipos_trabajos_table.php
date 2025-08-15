<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_trabajos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_turno', ['lubricentro', 'mecanica_ligera', 'mecanica_pesada']);
            $table->string('nombre'); // Ej: "Cambio de aceite"
            $table->integer('duracion'); // duración en minutos
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_trabajos');
    }
};