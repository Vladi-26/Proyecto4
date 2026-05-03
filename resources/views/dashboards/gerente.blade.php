<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del {{ __('Gerente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Listado de Usuarios Registrados</h3>
<table class="min-w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border p-2">Nombre</th>
            <th class="border p-2">Correo</th>
            <th class="border p-2">Rol</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $user)
        <tr>
            <td class="border p-2">{{ $user->name }}</td>
            <td class="border p-2">{{ $user->email }}</td>
            <td class="border p-2">
                <span class="px-2 py-1 rounded text-white {{ $user->role == 'gerente' ? 'bg-red-500' : ($user->role == 'empleado' ? 'bg-blue-500' : 'bg-green-500') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>