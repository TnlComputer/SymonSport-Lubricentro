<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTurno extends Model
{
  protected $fillable = ['nombre'];

  public $timestamps = false;

  public function turnos()
  {
    return $this->belongsToMany(Turno::class, 'turno_tipo_turno');
  }

}
