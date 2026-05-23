<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        // unique()->safeEmail garantiza que no se repitan correos entre instancias
        return [
            'nombre'    => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'correo'    => $this->faker->unique()->safeEmail(),
            'clave'     => Hash::make('123'),
            'rol'       => $this->faker->randomElement(['cliente', 'gerente']),
        ];
    }
}