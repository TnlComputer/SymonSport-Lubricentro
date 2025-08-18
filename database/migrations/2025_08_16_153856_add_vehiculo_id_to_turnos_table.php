<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('turnos', function (Blueprint $table) {
      $table->unsignedBigInteger('vehiculo_id')->nullable();
      $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::table('turnos', function (Blueprint $table) {
      $table->dropForeign(['vehiculo_id']);
      $table->dropColumn('vehiculo_id');
    });
  }
};
