<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Categoria;
use App\Models\DetalleVenta;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total de usuarios
        $totalUsuarios = Usuario::count();

        // 2. Total de vendedores (rol gerente)
        $totalVendedores = Usuario::where('rol', 'gerente')->count();

        // 3. Total de compradores (rol cliente)
        $totalCompradores = Usuario::where('rol', 'cliente')->count();

        // 4. Productos por categoría (usando relación belongsToMany)
        $productosPorCategoria = Categoria::withCount('productos')->get();

        // 5. Producto más vendido
        // Usa relación a través de detalle_ventas
        $productoMasVendido = Producto::withCount([
            'detalles as total_vendido' => function ($query) {
                $query->selectRaw('sum(cantidad)');
            }
        ])
        ->orderByDesc('total_vendido')
        ->first();

        // 6. Comprador más frecuente por categoría
        // Usamos Eloquent con relaciones hasMany y belongsToMany
        $compradorFrecuente = Usuario::where('rol', 'cliente')
            ->withCount('compras')
            ->orderByDesc('compras_count')
            ->first();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalVendedores',
            'totalCompradores',
            'productosPorCategoria',
            'productoMasVendido',
            'compradorFrecuente'
        ));
    }
}