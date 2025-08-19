<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'duracion',
        'tipo_turno_id',
    ];

    public function tipoTurno()
    {
        return $this->belongsTo(TipoTurno::class);
    }

    public function trabajos()
    {
        return $this->hasMany(TrabajoServicio::class);
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'servicio_turno');
    }
}
