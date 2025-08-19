<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('marca');
            $table->string('modelo');
            $table->string('patente')->unique();
            $table->integer('anio')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(1); // 1 = activo, 0 = eliminado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
