<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrabajoServicio;
use App\Models\Turno;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;

class TrabajosServicioSeeder extends Seeder
{
    public function run()
    {
        $turno = Turno::first();
        $servicio = Servicio::first();
        $vehiculo = Vehiculo::first();
        $user = User::where('role', 'admin')->first();

        TrabajoServicio::updateOrCreate(
            ['numero_operacion' => 1],
            [
                'vehiculo_id' => $vehiculo->id,
                'turno_id' => $turno->id,
                'servicio_id' => $servicio->id,
                'descripcion' => 'Trabajo de prueba',
                'tipo_trabajo' => 'revisión',
                'user_id' => $user->id,
                'fecha' => Carbon::today(),
            ]
        );
    }
}
