<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajoServicio extends Model
{
    use HasFactory;

    protected $table = 'trabajos_servicio';

    protected $fillable = [
        'vehiculo_id',
        'turno_id',
        'servicio_id',
        'numero_operacion',
        'descripcion',
        'tipo_trabajo',
        'user_id',
        'fecha',
        'activo',
    ];

    protected $dates = ['fecha'];

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
