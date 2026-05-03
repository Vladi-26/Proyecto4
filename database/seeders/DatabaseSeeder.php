<?php

namespace Database\Seeders;

use App\Models\Usuario; // Cambiado de User a Usuario
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Creamos el usuario Administrador para que tú puedas entrar
        Usuario::create([
            'nombre' => 'Milton Vladimir',
            'apellidos' => 'Administrador',
            'correo' => 'test@example.com',
            'clave' => Hash::make('123'), // Contraseña fácil para pruebas
            'rol' => 'administrador',
        ]);

        // 2. Creamos los 10 usuarios aleatorios (Juan, Mario, Maria, Pedro, etc.)
        // Esto usará el UsuarioFactory que configuramos antes
        Usuario::factory(10)->create();
    }
}
