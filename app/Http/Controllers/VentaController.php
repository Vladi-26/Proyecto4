<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\VentaValidadaComprador;
use App\Mail\VentaValidadaVendedor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VentaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Subir ticket de venta en disco PRIVADO
     * El ticket NO es accesible públicamente — se sirve por controlador
     */
    public function subirTicket(Request $request, Venta $venta)
    {
        $request->validate([
            'ticket' => 'required|image|max:2048',
        ]);

        // Verificar que el usuario tiene permiso
        $this->authorize('view', $venta);

        // Eliminar ticket anterior si existe
        if ($venta->ticket) {
            Storage::disk('local')->delete($venta->ticket);
        }

        // Storage::disk('local') guarda en storage/app/private — NO accesible públicamente
        $ruta = $request->file('ticket')->store('tickets', 'local');

        $venta->update(['ticket' => $ruta]);

        return redirect()->back()->with('success', 'Ticket subido correctamente.');
    }

    /**
     * Servir ticket desde disco privado (solo usuarios autorizados)
     * El archivo se sirve mediante este controlador, NO directamente
     */
    public function showTicket(Venta $venta)
    {
        // Aplicar Policy: solo el dueño o gerente puede ver el ticket
        $this->authorize('view', $venta);

        // Verificar que el ticket existe en disco privado
        if (!$venta->ticket || !Storage::disk('local')->exists($venta->ticket)) {
            abort(404, 'Ticket no encontrado.');
        }

        // Servir el archivo desde disco privado
        $archivo = Storage::disk('local')->get($venta->ticket);
        $mime    = Storage::disk('local')->mimeType($venta->ticket);

        return response($archivo, 200)->header('Content-Type', $mime);
    }

    /**
     * Valida la venta y envía correos
     */
    public function validar(Venta $venta)
    {
        // Aplicar Policy: solo gerente o administrador
        Gate::authorize('validate', $venta);

        $venta->update(['estatus' => 'validada']);

        // Enviar correos al comprador y vendedor
        Mail::to($venta->comprador->correo)->send(new VentaValidadaComprador($venta));
        Mail::to($venta->vendedor->correo)->send(new VentaValidadaVendedor($venta));

        return redirect()->back()->with('success', "Venta #{$venta->id} validada. Correos enviados.");
    }

    /**
     * Detalle de productos via hasManyThrough
     */
    public function detalleProductos(Venta $venta)
    {
        $productos = $venta->productos;
        return view('ventas.detalles', compact('venta', 'productos'));
    }
}