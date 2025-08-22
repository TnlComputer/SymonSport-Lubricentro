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
        'activo'
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
        return $this->belongsToMany(Turno::class, 'turno_servicio', 'servicio_id', 'turno_id')
            ->withPivot('cantidad', 'estado', 'activo')
            ->withTimestamps();
    }
}
