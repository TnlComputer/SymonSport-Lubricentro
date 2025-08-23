<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'articulo',
        'descripcion',
        'proveedor',
        'activo',
    ];

    // Relación: un producto tiene muchos precios
    public function precios()
    {
        return $this->hasMany(ProductoPrecio::class);
    }

    // Relación: un producto tiene muchos movimientos de stock
    public function stocks()
    {
        return $this->hasMany(ProductoStock::class);
    }

    // Precio actual (último activo)
    public function precioActual()
    {
        return $this->hasOne(ProductoPrecio::class)->where('activo', 1)->latestOfMany('fecha_desde');
    }

    // Stock actual (último movimiento)
    public function stockActual()
    {
        return $this->hasOne(ProductoStock::class)->where('activo', 1)->latestOfMany('fecha_movimiento');
    }
}
