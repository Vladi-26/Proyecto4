<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Manual - ITTG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-800">E-commerce ITTG</h2>
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Correo Institucional:</label>
                <input type="email" name="correo" class="w-full p-2 border border-gray-300 rounded" placeholder="usuario@tuxtla.tecnm.mx" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Contraseña:</label>
                <input type="password" name="clave" class="w-full p-2 border border-gray-300 rounded" placeholder="123" required>
            </div>

            <button type="submit" class="w-full bg-blue-700 text-white font-bold py-2 px-4 rounded hover:bg-blue-800 transition duration-300">
                Iniciar Sesión Manual
            </button>

            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
</body>
</html>