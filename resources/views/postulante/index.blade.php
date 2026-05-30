@extends('layouts.app')

@section('title', 'Postulantes')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">
        Postulantes
    </h1>

</div>

@if(session('success'))

    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

        {{ session('success') }}

    </div>

@endif

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">CI</th>
                <th class="p-3 text-left">Nombre</th>
                <th class="p-3 text-left">Correo</th>
                <th class="p-3 text-left">Teléfono</th>
                <th class="p-3 text-left">RUDE</th>
                <th class="p-3 text-left">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @foreach($postulantes as $postulante)

                <tr class="border-t">

                    <td class="p-3">{{ $postulante->ci }}</td>
                    <td class="p-3">{{ $postulante->nombre }}</td>
                    <td class="p-3">{{ $postulante->correo }}</td>
                    <td class="p-3">{{ $postulante->telefono }}</td>
                    <td class="p-3">{{ $postulante->rude }}</td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('postulante.edit', $postulante) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">

                            Editar

                        </a>

                        <form method="POST"
                              action="{{ route('postulante.destroy', $postulante) }}"
                              onsubmit="return confirm('¿Está seguro de eliminar este postulante?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">

                                Eliminar

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection