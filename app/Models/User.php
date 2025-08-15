<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    public function scopeClientes($query)
    {
        return $query->where('role', 'user');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
  
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // <-- agregar aquí para poder asignar el role
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
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
}