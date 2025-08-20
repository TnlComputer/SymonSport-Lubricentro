<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    // Columnas que se pueden llenar masivamente
    protected $fillable = [
        'vehiculo_id',
        'user_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    // Relaciones

    public function tipoTurnos()
    {
        return $this->belongsToMany(TipoTurno::class, 'turno_tipo', 'turno_id', 'tipo_turno_id');
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



    // Mutador para manejar la fecha automáticamente con Carbon
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
