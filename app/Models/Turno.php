<?php

// app/Models/Turno.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Turno extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'cliente_id',
    'servicio_id',
    'vehiculo_id',
    'tipo_turno',
    'fecha',
    'hora',
    'duracion',
    'status'
  ];

  // Relación con el cliente
  public function cliente()
  {
    return $this->belongsTo(User::class, 'cliente_id');
  }

  // Relación con el servicio
  public function servicios()
  {
    return $this->belongsToMany(Servicio::class, 'servicio_turno');
  }

  // Relación con el vehículo
  public function vehiculo()
  {
    return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
  }

  public function getTipoTurnoArrayAttribute()
{
    return explode(',', $this->tipo_turno);
}

public function tiposTurno()
{
    return $this->belongsToMany(TipoTurno::class, 'turno_tipo_turno');
}

  // Mutador de fecha a Carbon
  public function getFechaAttribute($value)
  {
    return Carbon::parse($value);
  }
}
