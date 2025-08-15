<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'cliente_id', 'servicio_id', 'fecha', 'hora', 'duracion', 'status'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}