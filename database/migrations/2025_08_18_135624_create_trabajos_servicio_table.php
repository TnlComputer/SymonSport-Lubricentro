<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trabajos_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->foreignId('turno_id')->constrained('turnos')->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('numero_operacion')->unique();
            $table->text('descripcion')->nullable();
            $table->string('tipo_trabajo')->nullable();
            $table->date('fecha')->nullable();
            $table->boolean('activo')->default(1); // 1 = activo, 0 = eliminado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajos_servicio');
    }
};
