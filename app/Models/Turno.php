<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id',
        'user_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'activo', 
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];



    // Relaciones

    // public function tipoTurnos()
    // {
    //     return $this->belongsToMany(TipoTurno::class, 'turno_tipo', 'turno_id', 'tipo_turno_id');
    // }
    public function tipoTurnos()
    {
        return $this->belongsToMany(
            TipoTurno::class,       // Modelo relacionado
            'turno_tipo_turno',     // Tabla pivot
            'turno_id',             // Foreign key en la pivot que apunta a este modelo
            'tipo_turno_id'         // Foreign key en la pivot que apunta a TipoTurno
        )->withTimestamps();
    }

    public function trabajos()
    {
        return $this->hasMany(TrabajoServicio::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipos_trabajo()
    {
        return $this->belongsToMany(TipoTurno::class, 'turno_tipo_turno', 'turno_id', 'tipo_turno_id');
    }

    // Relación con servicios
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'turno_servicio', 'turno_id', 'servicio_id')
            ->withPivot('cantidad', 'estado', 'activo')
            ->withTimestamps();
    }
    // Mutador para manejar la fecha automáticamente con Carbon
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
