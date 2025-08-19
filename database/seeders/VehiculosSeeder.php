<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\User;

class VehiculosSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::where('role', 'usuario')->get();

        foreach ($usuarios as $index => $user) {
            Vehiculo::updateOrCreate(
                ['patente' => 'ABC' . str_pad($index + 1, 3, '0', STR_PAD_LEFT)],
                [
                    'user_id' => $user->id,
                    'marca' => 'Ford',
                    'modelo' => 'Focus',
                    'anio' => 2015,
                    'observaciones' => 'Vehículo de prueba',
                ]
            );
        }
    }
}
