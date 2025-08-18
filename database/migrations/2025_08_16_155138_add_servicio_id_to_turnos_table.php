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
        $table->unsignedBigInteger('servicio_id')->nullable()->after('cliente_id');
        $table->foreign('servicio_id')->references('id')->on('servicios');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('turnos', function (Blueprint $table) {
            //
        });
    }
};
