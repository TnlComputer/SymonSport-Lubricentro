<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'nombre',
    'email',
    'password',
    'role',
    'telefono',
    'celular',
    'horario_atencion',
    'activo',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // Accesor opcional para admin
  public function getIsAdminAttribute(): bool
  {
    return $this->role === 'admin';
  }

  public function turnos(): HasMany
  {
    return $this->hasMany(Turno::class, 'usuario_id');
  }

  // public function vehiculos(): HasMany
  // {
  //   return $this->hasMany(Vehiculo::class);
  // }

  public function trabajos(): HasMany
  {
    return $this->hasMany(TrabajoServicio::class);
  }

  public function vehiculos()
  {
    return $this->hasMany(\App\Models\Vehiculo::class, 'user_id');
  }
}
