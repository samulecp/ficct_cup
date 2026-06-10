<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-600 to-indigo-700 flex items-center justify-center min-h-screen">

<div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8">

    <h1 class="text-2xl font-bold text-center mb-6">
        Iniciar Sesión
    </h1>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">

        @csrf

        <div>
            <label class="text-sm text-gray-600">Correo</label>
            <input type="email" name="email"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Contraseña</label>
            <input type="password" name="password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Entrar
        </button>

    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
        Sistema de Admisión Universitaria
    </p>

</div>

</body>
</html>