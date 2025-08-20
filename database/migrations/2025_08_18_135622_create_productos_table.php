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
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->integer('stock_min')->default(0);
            $table->integer('stock_max')->default(0);
            $table->decimal('costo', 10, 2)->default(0);
            $table->boolean('activo')->default(1); // 1 = activo, 0 = eliminado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
