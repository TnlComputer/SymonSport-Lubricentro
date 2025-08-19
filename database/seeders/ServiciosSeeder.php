<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        $servicios = [
            ['nombre' => 'Cambio de aceite', 'tipo_servicio' => 'lubricentro', 'duracion' => 30],
            ['nombre' => 'Cambio de filtro de aire', 'tipo_servicio' => 'lubricentro', 'duracion' => 20],
            ['nombre' => 'Cambio de pastillas de freno', 'tipo_servicio' => 'mecanica_ligera', 'duracion' => 60],
            ['nombre' => 'Reparación de motor', 'tipo_servicio' => 'mecanica_pesada', 'duracion' => 300],
        ];

        foreach ($servicios as $s) {
            Servicio::updateOrCreate(
                ['nombre' => $s['nombre']],
                [
                    'tipo_servicio' => $s['tipo_servicio'],
                    'duracion' => $s['duracion'],
                ]
            );
        }
    }
}
