@extends('layouts.app')

@section('title', 'Grupos')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">
        Gestión de Grupos
    </h1>

    <a href="{{ route('grupos.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Nuevo Grupo
    </a>

</div>

<div class="flex gap-2 mb-4">

    <form method="POST"
          action="{{ route('grupos.generar') }}">

        @csrf

        <button
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

            Generar Grupos

        </button>

    </form>

    <form method="POST"
          action="{{ route('grupos.asignarAutomaticamente') }}">

        @csrf

        <button
            class="bg-indigo-600 text-white px-4 py-2 rounded">

            Asignar Automáticamente

        </button>

    </form>

</div>

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    ID
                </th>

                <th class="p-3 text-left">
                    Grupo
                </th>

                <th class="p-3 text-left">
                    Periodo
                </th>

                <th class="p-3 text-left">
                    Alumnos
                </th>

                <th class="p-3 text-left">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($grupos as $grupo)

            <tr class="border-t">

                <td class="p-3">
                    {{ $grupo->id }}
                </td>

                <td class="p-3 font-semibold">
                    {{ $grupo->nombre }}
                </td>

                <td class="p-3">
                    {{ $grupo->periodo->nombre }}
                </td>

                <td class="p-3">

                    {{ $grupo->preinscripciones_count }}

                    /

                    {{ $grupo->periodo->max_alumno_grupo }}

                </td>

                <td class="p-3 flex gap-2">

                    <a href="{{ route('grupos.edit', $grupo) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Editar
                    </a>

                    <form method="POST"
                          action="{{ route('grupos.destroy', $grupo) }}">

                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-600 text-white px-3 py-1 rounded">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="p-4 text-center">

                    No existen grupos registrados

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-4">
    {{ $grupos->links() }}
</div>

@endsection