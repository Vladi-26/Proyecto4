<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Solo crear usuario administrador fijo, sin usar factories
        // (Faker no está disponible en producción con --no-dev)
        Usuario::firstOrCreate(
            ['correo' => 'test@example.com'],
            [
                'nombre'    => 'Administrador',
                'apellidos' => 'Sistema',
                'clave'     => Hash::make('123'),
                'rol'       => 'administrador',
            ]
        );
    }
}
