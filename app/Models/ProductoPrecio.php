<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoPrecio extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'costo',
        'venta',
        'fecha_desde',
        'fecha_hasta',
        'activo',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
