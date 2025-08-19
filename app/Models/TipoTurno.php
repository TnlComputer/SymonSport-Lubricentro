<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTurno extends Model
{
    use HasFactory;

    protected $table = 'tipo_turnos'; // asegúrate que coincida con la DB

    protected $fillable = [
        'nombre',
    ];

    public function tiposTurno()
    {
        return $this->belongsToMany(TipoTurno::class, 'turno_tipo_turno', 'turno_id', 'tipo_turno_id');
    }
}
