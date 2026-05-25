<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - ITTG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Listado de Usuarios</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm bg-red-500 text-white px-3 py-1 rounded">Cerrar Sesión</button>
            </form>
        </div>
        
        <table class="w-full border-collapse bg-white">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Apellidos</th>
                    <th class="p-3 text-left">Correo Institucional</th>
                    <th class="p-3 text-left">Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr class="border-b hover:bg-blue-50 transition">
                    <td class="p-3 text-gray-700">{{ $u->nombre }}</td>
                    <td class="p-3 text-gray-700">{{ $u->apellidos }}</td>
                    <td class="p-3 text-gray-600 font-mono text-sm">{{ $u->correo }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs font-bold uppercase 
                            {{ $u->rol == 'administrador' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                            {{ $u->rol }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>