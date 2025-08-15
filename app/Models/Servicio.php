<?php 

// app/Models/Servicio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
protected $fillable = ['nombre', 'tipo_turno', 'duracion'];
}