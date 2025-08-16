<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'role',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  const ROLE_ADMIN = 'admin';
  const ROLE_USER = 'user';

  public function isAdmin()
  {
    return $this->role === self::ROLE_ADMIN;
  }

  public function isUser()
  {
    return $this->role === self::ROLE_USER;
  }

  public function getEmailVerifiedAtFormattedAttribute()
  {
    return $this->email_verified_at ? $this->email_verified_at->format('d-m-Y H:i') : null;
  }

  // Relación con turnos
  public function turnos()
  {
    return $this->hasMany(Turno::class, 'cliente_id');
  }


  // Relación con servicios
  public function servicios()
  {
    return $this->hasMany(Servicio::class, 'cliente_id');
  }

  // Scope para obtener solo clientes
  public function scopeClientes($query)
  {
    return $query->where('role', self::ROLE_USER);
  }
}
