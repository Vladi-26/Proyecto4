<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('en_US');

        return [
            'nombre'    => $faker->firstName(),
            'apellidos' => $faker->lastName(),
            'correo'    => $faker->unique()->safeEmail(),
            'clave'     => Hash::make('123'),
            'rol'       => $faker->randomElement(['cliente', 'gerente']),
        ];
    }
}
