<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Crear Producto</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    {{-- enctype multipart obligatorio para subir archivos --}}
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Precio</label>
                <input type="number" name="precio" step="0.01" value="{{ old('precio') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Vendedor (usuario_id)</label>
            <input type="number" name="usuario_id" value="{{ old('usuario_id') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Categorías</label>
            <div class="flex flex-wrap gap-2">
                @foreach($categorias as $categoria)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}">
                        {{ $categoria->nombre }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Subida de múltiples fotos al disco PÚBLICO --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-1">
                Fotos del producto
                <span class="text-sm text-gray-500">(se guardan en disco público)</span>
            </label>
            <input type="file" name="fotos[]" multiple accept="image/*"
                   class="w-full border rounded px-3 py-2">
            <p class="text-xs text-gray-400 mt-1">Puedes seleccionar varias imágenes a la vez.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Guardar Producto
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