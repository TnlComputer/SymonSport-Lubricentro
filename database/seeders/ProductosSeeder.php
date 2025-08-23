<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        // Array de productos de ejemplo
        $productos = [
            [
                'articulo' => 'Aceite 5W30',
                'descripcion' => 'Aceite sintético para motores',
                'proveedor' => 'Lubricentro S.A.',
                'costo' => 80,
                'venta' => 150,
                'stock' => 20,
            ],
            [
                'articulo' => 'Filtro de aceite',
                'descripcion' => 'Filtro para autos',
                'proveedor' => 'Filtros SA',
                'costo' => 30,
                'venta' => 60,
                'stock' => 50,
            ],
            // Agregá más productos según necesites
        ];

        foreach ($productos as $p) {
            // Crear producto
            $producto = Producto::create([
                'articulo' => $p['articulo'],
                'descripcion' => $p['descripcion'],
                'proveedor' => $p['proveedor'],
                'activo' => 1,
            ]);

            // Crear precio inicial
            $producto->precios()->create([
                'costo' => $p['costo'],
                'venta' => $p['venta'],
                'fecha_desde' => now(),
                'activo' => 1,
            ]);

            // Crear stock inicial
            $producto->stocks()->create([
                'tipo_movimiento' => 'ingreso',
                'cantidad' => $p['stock'],
                'stock_total' => $p['stock'],
                'descripcion' => 'Stock inicial',
                'fecha_movimiento' => now(),
                'activo' => 1,
            ]);
        }
    }
}
