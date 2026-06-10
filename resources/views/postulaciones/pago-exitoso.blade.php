<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Exitoso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-xl p-8 text-center max-w-md w-full">

    <div class="text-green-500 text-6xl mb-4">✔</div>

    <h1 class="text-2xl font-bold mb-2">Pago realizado con éxito</h1>

    <p class="text-gray-600 mb-6">
        Tu postulación ha sido registrada correctamente.
        En breve será revisada por el sistema.
    </p>

    <div class="space-y-3">

        <a href="{{ route('postulacion.create') }}"
           class="block bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Volver al formulario
        </a>

        <a href="{{ route('login') }}"
           class="block bg-gray-600 text-white py-2 rounded hover:bg-gray-700">
            Ir a Login
        </a>

    </div>

</div>

</body>
</html>