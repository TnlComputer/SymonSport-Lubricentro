<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'sandokan992000@gmail.com'],
            ['name' => 'Administrador',
            'password' => bcrypt('Camisa00@'),
            'role' => User::ROLE_ADMIN,
            ]
        );
    }
}