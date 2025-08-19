<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tipo_turnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Tabla pivot Turno <-> TipoTurno
        Schema::create('turno_tipo_turno', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turno_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_turno_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turno_tipo_turno');
        Schema::dropIfExists('tipo_turnos');
    }
};
