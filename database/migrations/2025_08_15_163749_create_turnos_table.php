<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('turnos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('cliente_id'); // FK a users.id
        $table->enum('tipo_turno', ['lubricentro', 'mecanica ligera', 'mecanica pesada']);
        $table->date('fecha');
        $table->time('hora');
        $table->integer('duracion'); // en minutos
        $table->enum('status', ['pendiente', 'confirmado', 'completado', 'cancelado'])->default('pendiente');
        $table->timestamps();

        $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};