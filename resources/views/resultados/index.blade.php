@extends('layouts.app')

@section('title', 'Resultados Académicos')

@section('content')

<div class="flex justify-between mb-4">

    <h1 class="text-2xl font-bold">
        Resultados Académicos
    </h1>

    <form
        action="{{ route('admin.resultados.generar') }}"
        method="POST"
    >
        @csrf

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded"
        >
            Generar Resultados
        </button>

    </form>

    <form
    action="{{ route('admin.resultados.asignarCarreras') }}"
    method="POST"
>
    @csrf

    <button
        class="bg-green-600 text-white px-4 py-2 rounded"
    >
        Asignar Carreras
    </button>

</form>


</div>

<div class="flex justify-between items-center mb-4">

    <form method="GET"
          action="{{ route('admin.resultados.index') }}"
          class="flex gap-2">

        <input
            type="text"
            name="buscar"
            value="{{ request('buscar') }}"
            placeholder="Buscar postulante..."
            class="border rounded px-3 py-2">

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded">

            Buscar

        </button>

        <a href="{{ route('admin.resultados.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">

            Limpiar

        </a>

    </form>

</div>


<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3">
                Postulante
            </th>

            <th class="p-3">
                Promedio
            </th>

            <th class="p-3">
                Estado
            </th>

            <th class="p-3">
                Carrera
            </th>

        </tr>

    </thead>

    <tbody>

        @foreach($resultados as $resultado)

        <tr class="border-t">

            <td class="p-3">
                {{ $resultado->preinscripcion->postulante->nombre }}
            </td>

            <td class="p-3">
                {{ $resultado->promedio }}
            </td>

            <td class="p-3">
                {{ $resultado->estado }}
            </td>

            <td class="p-3">
                {{ $resultado->carrera?->nombre ?? 'Sin asignar' }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

</div>

@endsection