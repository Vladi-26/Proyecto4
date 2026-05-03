<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController; // Asegúrate de que este controlador exista
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes - Mini Proyecto 2 (Autenticación Manual)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// --- RUTAS DE AUTENTICACIÓN MANUAL ---
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/verificar-2fa', [App\Http\Controllers\Auth\LoginController::class, 'show2faForm'])->name('2fa.index');
Route::post('/verificar-2fa', [App\Http\Controllers\Auth\LoginController::class, 'verify2fa'])->name('2fa.verify');

// --- RUTAS PROTEGIDAS ---
Route::middleware(['auth'])->group(function () {

Route::get('/ventas/ticket/{venta}', [VentaController::class, 'showTicket'])->name('ventas.ticket');
// Ruta para que el Gerente valide la venta
Route::get('/ventas/{venta}/validar', [VentaController::class, 'validar'])->name('ventas.validar');
    // Redirección inicial según el rol al entrar a /dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->rol === 'administrador') {
            return redirect()->route('admin.usuarios.index');
        } elseif ($user->rol === 'gerente') {
            return redirect()->route('gerente.dashboard');
        }

        return view('dashboard'); // Vista para Clientes
    })->name('dashboard');

    // Rutas para el Administrador (CRUD de Usuarios - Puntos 9 y 10)
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index');

    // Rutas para el Gerente
    Route::get('/gerente/dashboard', function () {
        return view('dashboards.gerente');
    })->name('gerente.dashboard');

});

// Eliminamos el require auth.php porque ya estamos manejando el login aquí
