@extends('layouts.app')

@section('title', 'Postulaciones')

@section('content')

<div class="bg-white p-4 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Lista de Postulaciones</h1>

    <table class="w-full border">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nombre</th>
                <th class="p-2">CI</th>
                <th class="p-2">Estado</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>

        <tbody>
        @foreach($postulaciones as $p)
            <tr class="border-b">
                <td class="p-2">{{ $p->nombre }}</td>
                <td class="p-2">{{ $p->ci }}</td>
                <td class="p-2">
                    <span class="px-2 py-1 rounded text-white
                        {{ $p->estado_revision == 'APROBADO' ? 'bg-green-600' : ($p->estado_revision == 'RECHAZADO' ? 'bg-red-600' : 'bg-yellow-500') }}">
                        {{ $p->estado_revision }}
                    </span>
                </td>

                <td class="p-2">
                    <a href="{{ route('postulaciones.show', $p) }}"
                       class="text-blue-600 hover:underline">
                        Ver detalle
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

@endsection