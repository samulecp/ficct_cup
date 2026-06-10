@extends('layouts.app')

@section('title', 'Detalle Postulación')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">
        {{ $postulacion->nombre }}
    </h2>

    <p><b>CI:</b> {{ $postulacion->ci }}</p>
    <p><b>Correo:</b> {{ $postulacion->correo }}</p>

    <hr class="my-4">

    <h3 class="font-bold">Documentos</h3>

    <ul class="space-y-2 mt-2">
        <li>
            <a class="text-blue-600"
               target="_blank"
               href="{{ asset('storage/'.$postulacion->foto_ci) }}">
                Ver CI
            </a>
        </li>

        <li>
            <a class="text-blue-600"
               target="_blank"
               href="{{ asset('storage/'.$postulacion->titulo_bachiller) }}">
                Ver Título Bachiller
            </a>
        </li>

        <li>
            <a class="text-blue-600"
               target="_blank"
               href="{{ asset('storage/'.$postulacion->certificado_nacimiento) }}">
                Ver Certificado Nacimiento
            </a>
        </li>
    </ul>

    <hr class="my-4">

    <form method="POST"
          action="{{ route('postulaciones.estado', $postulacion) }}"
          class="flex gap-2">

        @csrf

        <button name="estado_revision" value="APROBADO"
                class="bg-green-600 text-white px-4 py-2 rounded">
            Aprobar
        </button>

        <button name="estado_revision" value="RECHAZADO"
                class="bg-red-600 text-white px-4 py-2 rounded">
            Rechazar
        </button>

    </form>

</div>

@endsection