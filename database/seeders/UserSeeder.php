<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
  public function run()
  {
    // Administrador
    User::updateOrCreate(
      ['email' => 'sandokan992000@gmail.com'],
      [
        'name' => 'Administrador',
        'password' => bcrypt('Camisa00@'),
        'role' => User::ROLE_ADMIN,
        'email_verified_at' => Carbon::now(),
      ]
    );

    // Usuario normal
    User::updateOrCreate(
      ['email' => 'tnlcomputer@gmail.com'],
      [
        'name' => 'Usuario TNL',
        'password' => bcrypt('Camisa00@'),
        'role' => User::ROLE_USER,
        'email_verified_at' => Carbon::now(),
      ]
    );
  }
}