@extends('layouts.app')

@section('title','Calificaciones')

@section('content')

<div class="flex justify-between items-center mb-4">

    <form method="GET"
          action="{{ route('calificaciones.index') }}"
          class="flex gap-2">

        <input
            type="text"
            name="buscar"
            value="{{ request('buscar') }}"
            placeholder="Buscar postulante, CI, grupo o materia..."
            class="border rounded px-3 py-2">

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded">

            Buscar

        </button>

        <a href="{{ route('calificaciones.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">

            Limpiar

        </a>

    </form>

</div>

<p class="mb-3 text-gray-600">

    Registros encontrados:

    <strong>
        {{ $calificaciones->count() }}
    </strong>

</p>

<div class="bg-white rounded shadow overflow-x-auto">

<form method="POST"
      action="{{ route('calificaciones.generar') }}">

    @csrf

    <button
        class="bg-green-600 text-white px-4 py-2 rounded">

        Generar Calificaciones

    </button>

</form>
<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3">CI</th>

            <th class="p-3">Postulante</th>

            <th class="p-3">Grupo</th>

            <th class="p-3">Materia</th>

            <th class="p-3">Ex1</th>

            <th class="p-3">Ex2</th>

            <th class="p-3">Ex3</th>

            <th class="p-3">Final</th>

            <th class="p-3">Acciones</th>

        </tr>

    </thead>

    <tbody>

    @foreach($calificaciones as $calificacion)

        <tr class="border-t">

            <td class="p-3">

                {{ $calificacion->preinscripcion->postulante->ci }}

            </td>

            <td class="p-3">

                {{ $calificacion->preinscripcion->postulante->nombre }}

            </td>

            <td class="p-3">

                {{ $calificacion->preinscripcion->grupo?->nombre }}

            </td>

            <td class="p-3">

                {{ $calificacion->clase->materia->nombre }}

            </td>

            <td class="p-3">

                {{ $calificacion->examen1 }}

            </td>

            <td class="p-3">

                {{ $calificacion->examen2 }}

            </td>

            <td class="p-3">

                {{ $calificacion->examen3 }}

            </td>

            <td class="p-3 font-bold">

                {{ $calificacion->nota_final }}

            </td>

            <td class="p-3">

                <a href="{{ route('calificaciones.edit',$calificacion) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded">

                    Editar

                </a>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>


</div>

@endsection




