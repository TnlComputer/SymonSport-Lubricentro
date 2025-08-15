<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        $servicios = [
            ['tipo_turno' => 'lubricentro', 'nombre' => 'Cambio de aceite', 'duracion' => 30],
            ['tipo_turno' => 'lubricentro', 'nombre' => 'Cambio de filtro de aire', 'duracion' => 20],
            ['tipo_turno' => 'mecanica_ligera', 'nombre' => 'Cambio de pastillas de freno', 'duracion' => 60],
            ['tipo_turno' => 'mecanica_pesada', 'nombre' => 'Reparación de motor', 'duracion' => 300],
        ];

        foreach ($servicios as $servicio) {
            Servicio::updateOrCreate(
                ['tipo_turno' => $servicio['tipo_turno'], 'nombre' => $servicio['nombre']],
                ['duracion' => $servicio['duracion']]
            );
        }
    }
}