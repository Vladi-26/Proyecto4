<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Administrativo</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Cerrar Sesión
            </button>
        </form>
    </div>

    {{-- ESTADÍSTICAS GENERALES --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500 text-sm">Total Usuarios</p>
            <p class="text-4xl font-bold text-blue-600">{{ $totalUsuarios }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500 text-sm">Total Vendedores</p>
            <p class="text-4xl font-bold text-green-600">{{ $totalVendedores }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500 text-sm">Total Compradores</p>
            <p class="text-4xl font-bold text-purple-600">{{ $totalCompradores }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        {{-- PRODUCTOS POR CATEGORÍA (belongsToMany) --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4 text-gray-700">Productos por Categoría</h2>
            <p class="text-xs text-gray-400 mb-3">Relación: belongsToMany</p>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left p-2">Categoría</th>
                        <th class="text-right p-2">Productos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productosPorCategoria as $categoria)
                    <tr class="border-t">
                        <td class="p-2">{{ $categoria->nombre }}</td>
                        <td class="p-2 text-right font-semibold">{{ $categoria->productos_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PRODUCTO MÁS VENDIDO (hasMany through DetalleVenta) --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4 text-gray-700">Producto Más Vendido</h2>
            <p class="text-xs text-gray-400 mb-3">Relación: hasMany → DetalleVenta</p>
            @if($productoMasVendido)
                <div class="bg-blue-50 rounded p-4">
                    <p class="font-bold text-blue-800 text-lg">{{ $productoMasVendido->nombre }}</p>
                    <p class="text-gray-600 text-sm">{{ $productoMasVendido->descripcion }}</p>
                    <p class="text-green-600 font-semibold mt-2">
                        ${{ number_format($productoMasVendido->precio, 2) }}
                    </p>
                    <p class="text-gray-500 text-sm mt-1">
                        Total vendido: <span class="font-bold">{{ $productoMasVendido->total_vendido ?? 0 }}</span> unidades
                    </p>
                </div>
            @else
                <p class="text-gray-400">No hay ventas registradas.</p>
            @endif
        </div>

    </div>

    {{-- COMPRADOR MÁS FRECUENTE --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Comprador Más Frecuente</h2>
        <p class="text-xs text-gray-400 mb-3">Relación: hasMany → Venta (compras)</p>
        @if($compradorFrecuente)
            <div class="flex items-center gap-4">
                <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center">
                    <span class="text-purple-700 font-bold text-lg">
                        {{ substr($compradorFrecuente->nombre, 0, 1) }}
                    </span>
                </div>
                <div>
                    <p class="font-bold text-gray-800">
                        {{ $compradorFrecuente->nombre }} {{ $compradorFrecuente->apellidos }}
                    </p>
                    <p class="text-gray-500 text-sm">{{ $compradorFrecuente->correo }}</p>
                    <p class="text-purple-600 text-sm font-semibold">
                        {{ $compradorFrecuente->compras_count }} compras realizadas
                    </p>
                </div>
            </div>
        @else
            <p class="text-gray-400">No hay compradores registrados.</p>
        @endif
    </div>

    {{-- ACCESOS RÁPIDOS --}}
    <div class="flex gap-4">
        <a href="{{ route('admin.usuarios.index') }}"
           class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Ver Usuarios
        </a>
        <a href="{{ route('productos.index') }}"
           class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
            Ver Productos
        </a>
    </div>
</div>

</body>
</html>