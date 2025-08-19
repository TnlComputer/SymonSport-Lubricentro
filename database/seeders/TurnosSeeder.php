<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turno;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;

class TurnosSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('role', 'usuario')->first();
        $vehiculo = Vehiculo::first();

        Turno::updateOrCreate(
            ['fecha' => Carbon::today(), 'hora_inicio' => '10:00'],
            [
                'vehiculo_id' => $vehiculo->id,
                'user_id' => $user->id,
                'hora_fin' => '11:00',
                'estado' => 'pendiente',
            ]
        );
    }
}
