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
    Schema::create('producto_stocks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
        $table->enum('tipo_movimiento', ['ingreso', 'egreso', 'ajuste']);
        $table->integer('cantidad');
        $table->integer('stock_total');
        $table->string('descripcion')->nullable();
        $table->dateTime('fecha_movimiento')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->boolean('activo')->default(1);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_stocks');
    }
};
