<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\VentaValidadaComprador;
use App\Mail\VentaValidadaVendedor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VentaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra el ticket de la venta (Punto 2 del proyecto).
     */
    public function showTicket(Venta $venta)
    {
        return view('ventas.ticket', compact('venta'));
    }

    /**
     * Valida la venta, cambia estatus y envía correos (Punto 3 y 4 del proyecto).
     */
    public function validar(Venta $venta)
    {
        // 1. Aplicamos la Policy (Punto 3 del profesor)
        // Verifica que el usuario tenga permiso 'validate' en VentaPolicy
        Gate::authorize('validate', $venta);

        // 2. Cambiamos el estatus en la base de datos
        $venta->update([
            'estatus' => 'validada'
        ]);

        // 3. Enviamos los correos (Punto 4 del profesor)
        // Se envían correos automáticos al comprador y al vendedor
        Mail::to($venta->comprador->correo)->send(new VentaValidadaComprador($venta));
        Mail::to($venta->vendedor->correo)->send(new VentaValidadaVendedor($venta));

        return "Venta #{$venta->id} validada con éxito. Los correos han sido enviados a Mailpit.";
    }

    /**
     * Ejemplo de relación Has Many Through (Punto 5 del proyecto).
     */
    public function detalleProductos(Venta $venta)
    {
        // Accedemos a los productos directamente a través de la relación definida en el Modelo
        $productos = $venta->productos; 
        return view('ventas.detalles', compact('venta', 'productos'));
    }
}