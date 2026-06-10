@extends('layouts.app')

@section('title','Mis Clases')

@section('content')

<h2 class="text-xl font-bold mb-4">


Mis Clases


</h2>

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">


<thead class="bg-gray-100">

    <tr>

        <th class="p-3">
            Materia
        </th>

        <th class="p-3">
            Docente
        </th>

        <th class="p-3">
            Aula
        </th>

        <th class="p-3">
            Horario
        </th>

    </tr>

</thead>

<tbody>

@foreach($clases as $clase)

    <tr class="border-t">

        <td class="p-3">

            {{ $clase->materia->nombre }}

        </td>

        <td class="p-3">

            {{ $clase->docente->user->name }}

        </td>

        <td class="p-3">

            {{ $clase->aula->nombre }}

        </td>

        <td class="p-3">

            {{ $clase->horario->dia }}
            -
            {{ $clase->horario->hora_inicio }}
            a
            {{ $clase->horario->hora_fin }}

        </td>

    </tr>

@endforeach

</tbody>


</table>

</div>

@endsection
