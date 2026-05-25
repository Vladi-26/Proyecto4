<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Venta #{{ $venta->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-2">Ticket — Venta #{{ $venta->id }}</h1>
    <p class="text-gray-500 mb-6">Estatus:
        <span class="font-semibold text-blue-600">{{ ucfirst($venta->estatus) }}</span>
    </p>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mostrar ticket desde disco PRIVADO (servido por controlador) --}}
    @if($venta->ticket)
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-2">
                ⚠️ Este ticket se sirve desde el disco privado — no es accesible públicamente.
            </p>
            <img src="{{ route('ventas.ticket', $venta) }}"
                 alt="Ticket de venta"
                 class="w-full rounded border">
        </div>
    @else
        <div class="bg-yellow-50 text-yellow-700 p-3 rounded mb-6">
            No hay ticket subido aún.
        </div>
    @endif

    {{-- Formulario para subir ticket al disco PRIVADO --}}
    <form action="{{ route('ventas.ticket.subir', $venta) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">
                Subir ticket
                <span class="text-sm text-gray-500">(se guarda en disco privado)</span>
            </label>
            <input type="file" name="ticket" accept="image/*"
                   class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Subir Ticket
        </button>
    </form>
</div>

</body>
</html>