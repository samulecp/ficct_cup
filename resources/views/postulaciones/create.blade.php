<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulación Universitaria</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

<div class="min-h-screen flex items-center justify-center py-10">

    <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg p-8">

        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold text-blue-700">
                Sistema de Admisión Universitaria
            </h1>

            <p class="text-gray-600 mt-2">
                Complete el formulario y adjunte sus documentos.
            </p>

        </div>

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

            {{-- BOTÓN LOGIN --}}
        <div class="mb-4 text-right">
            <a href="{{ route('login') }}"
               class="text-blue-600 hover:underline">
                ¿Ya tienes cuenta? Iniciar sesión
            </a>
        </div>

        <form method="POST"
              action="{{ route('postulacion.store') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label class="font-semibold">
                        CI
                    </label>

                    <input type="text"
                           name="ci"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label class="font-semibold">
                        Extensión
                    </label>

                    <input type="text"
                           name="extension"
                           placeholder="SC, LP, CB..."
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="font-semibold">
                        Nombre Completo
                    </label>

                    <input type="text"
                           name="nombre"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label class="font-semibold">
                        Correo Electrónico
                    </label>

                    <input type="email"
                           name="correo"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label class="font-semibold">
                        Teléfono
                    </label>

                    <input type="text"
                           name="telefono"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="font-semibold">
                        RUDE
                    </label>

                    <input type="text"
                           name="rude"
                           class="w-full border rounded p-2">
                </div>

            </div>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Selección Académica
            </h2>

            <div class="grid md:grid-cols-3 gap-4">

                <div>

                    <label class="font-semibold">
                        Periodo
                    </label>

                    <select name="periodo_id"
                            class="w-full border rounded p-2"
                            required>

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($periodos as $periodo)

                            <option value="{{ $periodo->id }}">
                                {{ $periodo->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="font-semibold">
                        Primera Carrera
                    </label>

                    <select name="carrera_primera_id"
                            class="w-full border rounded p-2"
                            required>

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($carreras as $carrera)

                            <option value="{{ $carrera->id }}">
                                {{ $carrera->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="font-semibold">
                        Segunda Carrera
                    </label>

                    <select name="carrera_segunda_id"
                            class="w-full border rounded p-2"
                            required>

                        <option value="">
                            Seleccione
                        </option>

                        @foreach($carreras as $carrera)

                            <option value="{{ $carrera->id }}">
                                {{ $carrera->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Documentos Requeridos
            </h2>

            <div class="grid md:grid-cols-3 gap-4">

                <div>

                    <label class="block font-semibold mb-2">
                        Fotocopia de CI
                    </label>

                    <input type="file"
                           name="foto_ci"
                           class="w-full border rounded p-2"
                           required>

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Título de Bachiller
                    </label>

                    <input type="file"
                           name="titulo_bachiller"
                           class="w-full border rounded p-2"
                           required>

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Certificado de Nacimiento
                    </label>

                    <input type="file"
                           name="certificado_nacimiento"
                           class="w-full border rounded p-2"
                           required>

                </div>

            </div>

            <div class="mt-8 text-center">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold">

                    Continuar al Pago

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>

