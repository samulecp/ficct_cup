@extends('layouts.app')

@section('title','Calificar')

@section('content')

<h2 class="text-xl font-bold mb-4">


{{ $clase->grupo->nombre }}

{{ $clase->materia->nombre }}

</h2>

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">

<thead class="bg-gray-100">

    <tr>

        <th class="p-3">CI</th>

        <th class="p-3">Alumno</th>

        <th class="p-3">Ex1</th>

        <th class="p-3">Ex2</th>

        <th class="p-3">Ex3</th>

        <th class="p-3">Final</th>

        <th class="p-3">Acción</th>

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

            {{ $calificacion->examen1 }}

        </td>

        <td class="p-3">

            {{ $calificacion->examen2 }}

        </td>

        <td class="p-3">

            {{ $calificacion->examen3 }}

        </td>

        <td class="p-3">

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
