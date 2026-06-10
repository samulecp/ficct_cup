@extends('layouts.app')

@section('title','Mis Calificaciones')

@section('content')

<h2 class="text-xl font-bold mb-4">


Mis Calificaciones


</h2>

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">


<thead class="bg-gray-100">

    <tr>

        <th class="p-3">
            Materia
        </th>

        <th class="p-3">
            Examen 1
        </th>

        <th class="p-3">
            Examen 2
        </th>

        <th class="p-3">
            Examen 3
        </th>

        <th class="p-3">
            Nota Final
        </th>

    </tr>

</thead>

<tbody>

@foreach($calificaciones as $calificacion)

    <tr class="border-t">

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

    </tr>

@endforeach

</tbody>


</table>

</div>

@endsection
