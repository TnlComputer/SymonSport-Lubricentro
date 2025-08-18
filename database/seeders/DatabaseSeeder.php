<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoTurno; // 👈 falta esto

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
    TipoTurnoSeeder::class,
    ServiciosSeeder::class,
    UserSeeder::class,
]);

  }
}
