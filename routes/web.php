<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\Admin\DashboardController;

// --- PÁGINA PRINCIPAL ---
Route::get('/', function () {
    return view('welcome');
});

// --- RUTAS DE AUTENTICACIÓN ---
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/verificar-2fa', [LoginController::class, 'show2faForm'])->name('2fa.index');
Route::post('/verificar-2fa', [LoginController::class, 'verify2fa'])->name('2fa.verify');

// --- RUTAS PROTEGIDAS ---
Route::middleware(['auth'])->group(function () {

    // Dashboard con redirección por rol
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->rol === 'administrador') {
    return redirect()->route('admin.dashboard');
        } elseif ($user->rol === 'gerente') {
            return redirect()->route('gerente.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // --- PRODUCTOS (CRUD con disco público) ---
    Route::resource('productos', ProductoController::class);

    // --- VENTAS ---
    // Ver ticket desde disco PRIVADO (servido por controlador con Policy)
    Route::get('/ventas/ticket/{venta}', [VentaController::class, 'showTicket'])
        ->name('ventas.ticket');

    // Subir ticket al disco PRIVADO
    Route::post('/ventas/{venta}/ticket', [VentaController::class, 'subirTicket'])
        ->name('ventas.ticket.subir');

    // Validar venta (solo gerente/admin)
    Route::get('/ventas/{venta}/validar', [VentaController::class, 'validar'])
        ->name('ventas.validar');

    // Detalle de productos via hasManyThrough
    Route::get('/ventas/{venta}/productos', [VentaController::class, 'detalleProductos'])
        ->name('ventas.productos');

    // --- ADMINISTRADOR ---
    Route::get('/admin/usuarios', [UserController::class, 'index'])
        ->name('admin.usuarios.index');

    // --- GERENTE ---
    Route::get('/gerente/dashboard', function () {
        return view('dashboards.gerente');
    })->name('gerente.dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

});