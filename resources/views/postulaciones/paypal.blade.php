<!DOCTYPE html>
<html>
<head>
    <title>Pago PayPal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">

    <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">
        PayPal Sandbox
    </h1>

    <div class="text-center">

        <img
            src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg"
            class="h-16 mx-auto mb-6">

        <p class="text-xl mb-4">
            Derecho de Admisión
        </p>

        <p class="text-4xl font-bold text-green-600 mb-6">
            Bs. 700
        </p>

        <form
            action="{{ route('postulacion.pagar',$postulacion->id) }}"
            method="POST">

            @csrf

            <button
                class="bg-blue-600 text-white px-8 py-3 rounded text-lg">

                Pagar con PayPal

            </button>

        </form>

    </div>

</div>




</body>
</html>