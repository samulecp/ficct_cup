@extends('layouts.app')

@section('title', 'Preinscripciones')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('preinscripciones.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Nueva Preinscripción
    </a>

    <form method="GET"
          action="{{ route('preinscripciones.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar preinscripción..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

        <a href="{{ route('preinscripciones.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Limpiar
        </a>

    </form>

</div>

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    CI
                </th>

                <th class="p-3 text-left">
                    Nombre
                </th>

                <th class="p-3 text-left">
                    Periodo
                </th>

                <th class="p-3 text-left">
                    Primera Opción
                </th>

                <th class="p-3 text-left">
                    Segunda Opción
                </th>

                <th class="p-3 text-left">
                    Grupo
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($preinscripciones as $pre)

                <tr class="border-t">

                    <td class="p-3">

                        {{ $pre->postulante->ci }}

                    </td>

                    <td class="p-3">

                        {{ $pre->postulante->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->periodo->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->carreraPrimera->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->carreraSegunda->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $pre->grupo?->nombre ?? 'Sin asignar' }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection