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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App/Models/Turno.php

    public function cliente()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // 'usuario_id' es la FK que apunta al User
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    // App/Models/Turno.php
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'turno_servicio', 'turno_id', 'servicio_id');
    }


    // App/Models/Turno.php

    public function tiposTurno()
    {
        return $this->belongsToMany(TipoTurno::class, 'turno_tipo_turno', 'turno_id', 'tipo_turno_id');
    }

    // Mutador para manejar la fecha automáticamente con Carbon
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
