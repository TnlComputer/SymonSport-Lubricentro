<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        $productos = [
            [
                'nombre' => 'Aceite 10W40',
                'descripcion' => 'Aceite sintético para motores',
                'precio' => 5000,
                'stock' => 50,
                'stock_min' => 10,
                'stock_max' => 200,
                'costo' => 3500,
            ],
            [
                'nombre' => 'Filtro de aceite',
                'descripcion' => 'Filtro de repuesto',
                'precio' => 1500,
                'stock' => 100,
                'stock_min' => 20,
                'stock_max' => 300,
                'costo' => 800,
            ],
        ];

        foreach ($productos as $p) {
            Producto::updateOrCreate(
                ['nombre' => $p['nombre']],
                [
                    'descripcion' => $p['descripcion'],
                    'precio' => $p['precio'],
                    'stock' => $p['stock'],
                    'stock_min' => $p['stock_min'],
                    'stock_max' => $p['stock_max'],
                    'costo' => $p['costo'],
                ]
            );
        }
    }
}
