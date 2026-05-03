<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Gerente
        User::create([
            'name' => 'Gerente',
            'email' => 'gerente@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'gerente',
        ]);

        // Empleado
        User::create([
            'name' => 'Empleado',
            'email' => 'empleado@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'empleado',
        ]);

        // Cliente
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'cliente',
        ]);
    }
}
