<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTurno extends Model
{
    use HasFactory;

    protected $table = 'tipo_turnos'; // asegúrate que coincida con la DB

    protected $fillable = ['nombre', 'activo'];

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'turno_tipo_turno', 'tipo_turno_id', 'turno_id');
    }
}
