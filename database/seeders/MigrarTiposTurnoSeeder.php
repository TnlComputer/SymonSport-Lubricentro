<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Turno;
use App\Models\TipoTurno;

class MigrarTiposTurnoSeeder extends Seeder
{
    public function run(): void
    {
        $turnos = Turno::all();

        foreach ($turnos as $turno) {
            $tipos = explode(',', $turno->tipo_turno); // si hay varios separados por coma
            foreach ($tipos as $nombre) {
                $nombre = trim($nombre);
                $tipo = TipoTurno::firstOrCreate(['nombre' => $nombre]);
                $turno->tiposTurno()->attach($tipo->id);
            }
        }
    }
}

