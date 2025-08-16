<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Turno extends Model
{
  protected $fillable = [
    'cliente_id',
    'servicio_id',
    'fecha',
    'hora',
    'duracion',
    'status'
  ];

  // Relación con el cliente (usuario)
  public function cliente()
  {
    return $this->belongsTo(User::class, 'cliente_id');
  }

  // Relación con el servicio
  public function servicio()
  {
    return $this->belongsTo(Servicio::class);
  }

  // Accessor para que la fecha sea Carbon automáticamente
  public function getFechaAttribute($value)
  {
    return Carbon::parse($value);
  }
}