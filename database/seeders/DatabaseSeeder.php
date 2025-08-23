<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {

    $this->call([
      UsersSeeder::class,
      ProductosSeeder::class,
      ServiciosSeeder::class,
      VehiculosSeeder::class,
      TipoTurnoSeeder::class,
      TurnosSeeder::class,
      TrabajosServicioSeeder::class,
    ]);
  }
}
