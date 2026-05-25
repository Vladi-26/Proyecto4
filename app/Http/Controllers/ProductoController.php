<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    // Listar productos
    public function index()
    {
        $productos = Producto::with('categorias', 'vendedor')->get();
        return view('productos.index', compact('productos'));
    }

    // Formulario crear
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // Guardar producto con fotos en disco PÚBLICO
    public function store(ProductoRequest $request)
    {
        $fotos = [];

        // Guardamos cada foto en disco público
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                // Storage::disk('public') guarda en storage/app/public
                // accesible desde /storage/...
                $ruta = $foto->store('productos', 'public');
                $fotos[] = $ruta;
            }
        }

        $producto = Producto::create([
            'nombre'     => $request->nombre,
            'descripcion'=> $request->descripcion,
            'precio'     => $request->precio,
            'stock'      => $request->stock,
            'usuario_id' => $request->usuario_id,
            'fotos'      => $fotos,
        ]);

        // Asociar categorías
        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    // Mostrar producto
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // Formulario editar
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar producto
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $fotos = $producto->fotos ?? [];

        if ($request->hasFile('fotos')) {
            // Eliminar fotos anteriores del disco público
            foreach ($fotos as $fotoAnterior) {
                Storage::disk('public')->delete($fotoAnterior);
            }
            $fotos = [];

            foreach ($request->file('fotos') as $foto) {
                $ruta = $foto->store('productos', 'public');
                $fotos[] = $ruta;
            }
        }

        $producto->update([
            'nombre'     => $request->nombre,
            'descripcion'=> $request->descripcion,
            'precio'     => $request->precio,
            'stock'      => $request->stock,
            'usuario_id' => $request->usuario_id,
            'fotos'      => $fotos,
        ]);

        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        // Eliminar fotos del disco público
        if ($producto->fotos) {
            foreach ($producto->fotos as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}