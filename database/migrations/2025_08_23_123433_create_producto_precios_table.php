<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('producto_precios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->decimal('costo', 10, 2);
            $table->decimal('venta', 10, 2);
            $table->dateTime('fecha_desde')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('fecha_hasta')->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_precios');
    }
};
