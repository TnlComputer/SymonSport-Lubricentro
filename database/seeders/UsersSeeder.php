<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
  public function run()
  {
    // Administrador
    User::updateOrCreate(
      ['email' => 'sandokan992000@gmail.com'],
      [
        'nombre' => 'Administrador',
        'password' => bcrypt('Camisa00@'),
        'role' => 'admin',
        'telefono' => '011-12345678',
        'celular' => '1149156462',
        'horario_atencion' => '08:00-17:00',
        'email_verified_at' => Carbon::now(),
      ]
    );

    // Usuarios normales
    $usuarios = [
      ['email' => 'tnlcomputer@hotmail.com', 'nombre' => 'Usuario TNL'],
      ['email' => 'tnlcomputer@gmail.com', 'nombre' => 'Jorge'],
      ['email' => 'jgmartinez1965@gmail.com', 'nombre' => 'Jorge Martinez'],
    ];

    foreach ($usuarios as $u) {
      User::updateOrCreate(
        ['email' => $u['email']],
        [
          'nombre' => $u['nombre'],
          'password' => bcrypt('Camisa00@'),
          'role' => 'usuario',
          'telefono' => '011-00000000',
          'celular' => '1550000000',
          'horario_atencion' => '08:00-17:00',
          'email_verified_at' => Carbon::now(),
        ]
      );
    }
  }
}
