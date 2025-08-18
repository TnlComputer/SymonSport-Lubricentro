<?php

// app/Models/Servicio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
  protected $fillable = ['nombre', 'tipo_turno', 'duracion'];

  public function turnos()
  {
    return $this->belongsToMany(Turno::class, 'servicio_turno');
  }
}
