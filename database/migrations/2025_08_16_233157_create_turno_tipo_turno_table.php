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
    Schema::create('turno_tipo_turno', function (Blueprint $table) {
      $table->id();
      $table->foreignId('turno_id')->constrained()->onDelete('cascade');
      $table->foreignId('tipo_turno_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('turno_tipo_turno');
  }
};
