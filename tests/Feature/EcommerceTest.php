<?php

namespace Tests\Feature;

use App\Models\Usuario;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcommerceTest extends TestCase
{
    use RefreshDatabase;

    // Prueba 1: Página principal responde correctamente
    public function test_pagina_principal_responde_correctamente(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Prueba 2: Página de login responde correctamente
    public function test_pagina_login_responde_correctamente(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // Prueba 3: Dashboard requiere autenticación
    public function test_dashboard_requiere_autenticacion(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    // Prueba 4: Login con credenciales incorrectas muestra error
    public function test_login_incorrecto_muestra_error(): void
    {
        $response = $this->post('/login', [
            'correo' => 'correo@incorrecto.com',
            'clave'  => 'claveincorrecta',
        ]);
        $response->assertSessionHasErrors();
    }

    // Prueba 5: Usuario autenticado existe en base de datos con rol correcto
    public function test_usuario_autenticado_existe_en_base_de_datos(): void
    {
        $usuario = Usuario::factory()->create(['rol' => 'cliente']);

        $this->assertDatabaseHas('usuarios', [
            'id'  => $usuario->id,
            'rol' => 'cliente',
        ]);
    }

    // Prueba 6: Producto se almacena en base de datos
    public function test_producto_se_almacena_en_base_de_datos(): void
    {
        $vendedor = Usuario::factory()->create(['rol' => 'cliente']);

        Producto::create([
            'nombre'      => 'Teclado Mecánico',
            'descripcion' => 'Teclado mecánico RGB para gaming',
            'precio'      => 750.00,
            'stock'       => 20,
            'usuario_id'  => $vendedor->id,
        ]);

        $this->assertDatabaseHas('productos', [
            'nombre' => 'Teclado Mecánico',
        ]);
    }

    // Prueba 7: Panel admin requiere autenticación
    public function test_panel_admin_requiere_autenticacion(): void
    {
        $response = $this->get('/admin/usuarios');
        $response->assertRedirect('/login');
    }

    // Prueba 8: Tabla productos refleja correctamente los datos
    public function test_tabla_productos_refleja_correctamente_los_datos(): void
    {
        $this->assertDatabaseMissing('productos', ['nombre' => 'Monitor 4K']);

        $vendedor = Usuario::factory()->create();
        Producto::create([
            'nombre'      => 'Monitor 4K',
            'descripcion' => 'Monitor ultra HD',
            'precio'      => 5500.00,
            'stock'       => 5,
            'usuario_id'  => $vendedor->id,
        ]);

        $this->assertDatabaseHas('productos', ['nombre' => 'Monitor 4K']);
    }

    // Prueba 9: Se pueden crear múltiples productos sin conflicto
    public function test_se_pueden_crear_multiples_productos(): void
    {
        $vendedor = Usuario::factory()->create();

        Producto::create(['nombre' => 'Producto A', 'descripcion' => 'Desc A', 'precio' => 100, 'stock' => 10, 'usuario_id' => $vendedor->id]);
        Producto::create(['nombre' => 'Producto B', 'descripcion' => 'Desc B', 'precio' => 200, 'stock' => 5, 'usuario_id' => $vendedor->id]);

        $this->assertDatabaseHas('productos', ['nombre' => 'Producto A']);
        $this->assertDatabaseHas('productos', ['nombre' => 'Producto B']);
    }

    // Prueba 10: Usuario factory se crea correctamente en la base de datos
    public function test_usuario_factory_se_crea_en_base_de_datos(): void
    {
        $usuario = Usuario::factory()->create(['rol' => 'gerente']);

        $this->assertDatabaseHas('usuarios', [
            'id'  => $usuario->id,
            'rol' => 'gerente',
        ]);
    }
}
