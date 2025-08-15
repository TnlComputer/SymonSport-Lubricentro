<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('articulo')->unique();
            $table->string('descripcion');
            $table->decimal('costo', 10, 2);
            $table->decimal('venta', 10, 2);
            $table->string('proveedor')->nullable();
            $table->integer('stock_minimo')->default(0);
            $table->integer('stock_maximo')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('status')->default(true); // true = activo, false = inactivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};