<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Catálogo de Productos</h1>
        <a href="{{ route('productos.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nuevo Producto
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($productos as $producto)
        <div class="bg-white rounded-lg shadow p-4">

            {{-- Fotos del producto desde disco PÚBLICO --}}
            @if($producto->fotos && count($producto->fotos) > 0)
                <img src="{{ asset('storage/' . $producto->fotos[0]) }}"
                     alt="{{ $producto->nombre }}"
                     class="w-full h-48 object-cover rounded mb-3">
            @else
                <div class="w-full h-48 bg-gray-200 rounded mb-3 flex items-center justify-center text-gray-400">
                    Sin imagen
                </div>
            @endif

            <h2 class="font-bold text-lg">{{ $producto->nombre }}</h2>
            <p class="text-gray-600 text-sm mb-2">{{ $producto->descripcion }}</p>
            <p class="text-green-600 font-semibold">${{ number_format($producto->precio, 2) }}</p>
            <p class="text-gray-500 text-sm">Stock: {{ $producto->stock }}</p>

            {{-- Categorías --}}
            <div class="mt-2 flex flex-wrap gap-1">
                @foreach($producto->categorias as $categoria)
                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">
                        {{ $categoria->nombre }}
                    </span>
                @endforeach
            </div>

            <div class="mt-3 flex gap-2">
                <a href="{{ route('productos.edit', $producto) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                    Editar
                </a>
                <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600"
                            onclick="return confirm('¿Eliminar producto?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

</body>
</html>