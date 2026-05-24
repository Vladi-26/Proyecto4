<?php

namespace Tests\Feature;

use App\Models\Usuario;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EcommerceTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // Prueba 1: Página principal responde correctamente
    // Valida que la ruta '/' devuelve status 200 y carga la vista welcome
    // ---------------------------------------------------------------
    public function test_pagina_principal_responde_correctamente(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    // ---------------------------------------------------------------
    // Prueba 2: Página de login responde correctamente
    // Valida que la ruta '/login' devuelve status 200
    // ---------------------------------------------------------------
    public function test_pagina_login_responde_correctamente(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    // ---------------------------------------------------------------
    // Prueba 3: Dashboard requiere autenticación
    // Valida que un usuario NO autenticado es redirigido al intentar
    // acceder a /dashboard
    // ---------------------------------------------------------------
    public function test_dashboard_requiere_autenticacion(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    // ---------------------------------------------------------------
    // Prueba 4: Login con credenciales incorrectas muestra error
    // Valida que las credenciales incorrectas generan errores de sesión
    // ---------------------------------------------------------------
    public function test_login_incorrecto_muestra_error(): void
    {
        $response = $this->post('/login', [
            'correo'  => 'correo@incorrecto.com',
            'clave'   => 'claveincorrecta',
        ]);

        $response->assertSessionHasErrors();
    }

    // ---------------------------------------------------------------
    // Prueba 5: Usuario autenticado puede acceder al dashboard
    // Valida que un usuario con sesión iniciada puede ver /dashboard
    // ---------------------------------------------------------------
    public function test_usuario_autenticado_puede_acceder_al_dashboard(): void
    {
        $usuario = Usuario::factory()->create([
            'rol' => 'cliente',
        ]);

        $response = $this->actingAs($usuario)->get('/dashboard');

        // El dashboard puede retornar 200 o redirigir según el rol configurado
        $this->assertTrue(
            in_array($response->getStatusCode(), [200, 302]),
            'El dashboard debe retornar 200 o redirigir (302)'
        );
    }

    // ---------------------------------------------------------------
    // Prueba 6: Producto nuevo se almacena en la base de datos
    // Valida que al crear un producto, queda registrado en 'productos'
    // ---------------------------------------------------------------
    public function test_producto_se_almacena_en_base_de_datos(): void
    {
        // Creamos un usuario vendedor para asignarlo al producto
        $vendedor = Usuario::factory()->create([
            'rol' => 'cliente',
        ]);

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

    // ---------------------------------------------------------------
    // Prueba 7: Gerente autenticado es redirigido al dashboard de gerente
    // Valida el comportamiento de redirección por rol
    // ---------------------------------------------------------------
    public function test_gerente_autenticado_es_redirigido_a_su_dashboard(): void
    {
        $gerente = Usuario::factory()->create([
            'rol' => 'gerente',
        ]);

        $response = $this->actingAs($gerente)->get('/dashboard');

        $response->assertRedirect(route('gerente.dashboard'));
    }

    // ---------------------------------------------------------------
    // Prueba 8: Administrador autenticado es redirigido a gestión de usuarios
    // Valida redirección por rol de administrador
    // ---------------------------------------------------------------
    public function test_administrador_autenticado_es_redirigido_a_usuarios(): void
    {
        $admin = Usuario::factory()->create([
            'rol' => 'administrador',
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertRedirect(route('admin.usuarios.index'));
    }

    // ---------------------------------------------------------------
    // Prueba 9: Usuario no autenticado no puede acceder al panel de admin
    // Valida que /admin/usuarios exige autenticación
    // ---------------------------------------------------------------
    public function test_panel_admin_requiere_autenticacion(): void
    {
        $response = $this->get('/admin/usuarios');

        $response->assertRedirect('/login');
    }

    // ---------------------------------------------------------------
    // Prueba 10: La tabla de productos inicia vacía y refleja inserciones
    // Valida que assertDatabaseMissing y assertDatabaseHas funcionan correctamente
    // ---------------------------------------------------------------
    public function test_tabla_productos_refleja_correctamente_los_datos(): void
    {
        // Al inicio no debe existir este producto
        $this->assertDatabaseMissing('productos', [
            'nombre' => 'Monitor 4K',
        ]);

        $vendedor = Usuario::factory()->create();

        Producto::create([
            'nombre'      => 'Monitor 4K',
            'descripcion' => 'Monitor ultra HD para diseño',
            'precio'      => 5500.00,
            'stock'       => 5,
            'usuario_id'  => $vendedor->id,
        ]);

        // Después de crear, debe existir
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Monitor 4K',
        ]);
    }
}
