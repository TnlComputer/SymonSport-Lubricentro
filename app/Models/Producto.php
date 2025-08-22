<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'articulo',
        'descripcion',
        'costo',
        'venta',
        'proveedor',
        'stock_minimo',
        'stock_maximo',
        'stock',
        'status',
        'activo',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
