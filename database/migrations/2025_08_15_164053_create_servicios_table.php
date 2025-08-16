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
    Schema::create('servicios', function (Blueprint $table) {
      $table->id();
      $table->string('nombre'); // Ej: Cambio de aceite, Pastillas de freno
      $table->text('descripcion')->nullable(); // Opcional, descripción del servicio
      $table->enum('tipo_turno', ['lubricentro', 'mecanica_ligera', 'mecanica_pesada']);
      $table->integer('duracion'); // en minutos
      $table->unsignedBigInteger('cliente_id')->nullable(); // Relación con users
      $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('servicios');
  }
};