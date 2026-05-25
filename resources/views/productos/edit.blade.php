<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Precio</label>
                <input type="number" name="precio" step="0.01"
                       value="{{ old('precio', $producto->precio) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Stock</label>
                <input type="number" name="stock"
                       value="{{ old('stock', $producto->stock) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Vendedor (usuario_id)</label>
            <input type="number" name="usuario_id"
                   value="{{ old('usuario_id', $producto->usuario_id) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Categorías</label>
            <div class="flex flex-wrap gap-2">
                @foreach($categorias as $categoria)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}"
                            {{ $producto->categorias->contains($categoria->id) ? 'checked' : '' }}>
                        {{ $categoria->nombre }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Fotos actuales --}}
        @if($producto->fotos && count($producto->fotos) > 0)
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Fotos actuales</label>
                <div class="flex gap-2 flex-wrap">
                    @foreach($producto->fotos as $foto)
                        <img src="{{ asset('storage/' . $foto) }}"
                             class="w-24 h-24 object-cover rounded border">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-1">
                Nuevas fotos
                <span class="text-sm text-gray-500">(reemplazará las actuales)</span>
            </label>
            <input type="file" name="fotos[]" multiple accept="image/*"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
                Actualizar Producto
            </button>
            <a href="{{ route('productos.index') }}"
               class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                Cancelar
            </a>
        </div>
    </form>
</div>

</body>
</html>
