<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'patente',
        'marca',
        'modelo',
        'anio',
        'observaciones',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trabajos()
    {
        return $this->hasMany(TrabajoServicio::class);
    }
}
