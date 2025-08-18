<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turno;
use App\Models\TipoTurno;

class TipoTurnoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear los tipos de turno
        $tipos = ['lubricentro', 'mecánica ligera', 'mecánica pesada'];

        foreach ($tipos as $nombre) {
            TipoTurno::firstOrCreate(['nombre' => $nombre]);
        }

        // Migrar los turnos existentes a la tabla pivot
        Turno::all()->each(function ($turno) {
            if (!empty($turno->tipo_turno)) {
                $tipo = TipoTurno::where('nombre', $turno->tipo_turno)->first();
                if ($tipo) {
                    $turno->tiposTurno()->syncWithoutDetaching([$tipo->id]);
                }
            }
        });
    }
}

