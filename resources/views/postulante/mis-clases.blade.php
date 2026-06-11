@extends('layouts.app')

@section('title','Mi Horario')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Mi Horario de Clases
</h2>

@php

$dias = [
    'LUNES',
    'MARTES',
    'MIERCOLES',
    'JUEVES',
    'VIERNES',
    'SABADO'
];

@endphp

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="w-full border-collapse">

    <thead>

        <tr class="bg-blue-600 text-white">

            <th class="p-4 border">
                Hora
            </th>

            @foreach($dias as $dia)

                <th class="p-4 border">
                    {{ $dia }}
                </th>

            @endforeach

        </tr>

    </thead>

    <tbody>

        @foreach($horarioGrid as $hora => $fila)

        <tr>

            <td class="border p-4 font-semibold bg-gray-50">

                {{ $hora }}

            </td>

            @foreach($dias as $dia)

                <td class="border p-3 text-center align-middle h-24">

                    @if(isset($fila[$dia]))

                        <div class="font-bold text-blue-700">

                            {{ $fila[$dia]->materia->nombre }}

                        </div>

                        <div class="text-sm text-gray-600">

                            Aula:
                            {{ $fila[$dia]->aula->nombre }}

                        </div>

                        <div class="text-xs text-gray-500">

                            {{ $fila[$dia]->docente->user->name }}

                        </div>

                    @endif

                </td>

            @endforeach

        </tr>

        @endforeach

    </tbody>

</table>

</div>

@endsection