<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuario administrador fijo
        Usuario::firstOrCreate(
            ['correo' => 'test@example.com'],
            [
                'nombre'    => 'Milton Vladimir',
                'apellidos' => 'Administrador',
                'clave'     => Hash::make('123'),
                'rol'       => 'administrador',
            ]
        );

        // 2. Usuario gerente fijo para pruebas
        Usuario::firstOrCreate(
            ['correo' => 'gerente@example.com'],
            [
                'nombre'    => 'Carlos',
                'apellidos' => 'Gerente',
                'clave'     => Hash::make('123'),
                'rol'       => 'gerente',
            ]
        );

        // 3. 70 compradores (clientes)
        $clientes = Usuario::factory(70)->cliente()->create();

        // 4. 30 vendedores (gerentes)
        $vendedores = Usuario::factory(30)->vendedor()->create();

        // 5. Crear categorías base
        $categorias = [
            'Electrónica', 'Ropa', 'Hogar', 'Deportes', 'Juguetes',
            'Libros', 'Alimentos', 'Herramientas', 'Belleza', 'Automóviles'
        ];

        foreach ($categorias as $nombre) {
            Categoria::firstOrCreate(['nombre' => $nombre]);
        }

        $todasCategorias = Categoria::all();

        // 6. Cada vendedor crea mínimo 3 productos
        foreach ($vendedores as $vendedor) {
            $numProductos = rand(3, 5);
            for ($i = 0; $i < $numProductos; $i++) {
                $producto = Producto::create([
                    'nombre'      => fake()->words(3, true),
                    'descripcion' => fake()->sentence(),
                    'precio'      => fake()->randomFloat(2, 50, 5000),
                    'stock'       => fake()->numberBetween(1, 100),
                    'usuario_id'  => $vendedor->id,
                ]);

                // Asignar al menos 1 categoría aleatoria
                $producto->categorias()->attach(
                    $todasCategorias->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        }
    }
}
