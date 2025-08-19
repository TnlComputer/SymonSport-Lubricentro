<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turno_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turno_id')->constrained('turnos')->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->enum('estado', ['pendiente', 'realizado'])->default('pendiente');
            $table->boolean('activo')->default(1); // 1 = activo, 0 = eliminado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turno_servicio');
    }
};
