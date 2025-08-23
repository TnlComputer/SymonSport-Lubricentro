<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoStock extends Model
{
  use HasFactory;

  protected $fillable = [
    'producto_id',
    'tipo_movimiento',
    'cantidad',
    'stock_total',
    'descripcion',
    'fecha_movimiento',
    'activo',
  ];

  public function producto()
  {
    return $this->belongsTo(Producto::class);
  }
}
