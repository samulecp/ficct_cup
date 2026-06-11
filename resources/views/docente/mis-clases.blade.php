@extends('layouts.app')

@section('title','Mis Clases')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Mis Clases
    </h1>

    <p class="text-gray-500">
        Horario semanal del docente
    </p>
</div>

@php
    $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
@endphp

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full border-collapse">

    {{-- ENCABEZADO --}}
    <thead class="bg-gray-100">

        <tr>

            {{-- columna izquierda (horarios) --}}
            <th class="p-3 text-left w-40">
                Horario
            </th>

            {{-- días arriba --}}
            @foreach($dias as $dia)
                <th class="p-3 text-center">
                    {{ $dia }}
                </th>
            @endforeach

        </tr>

    </thead>

    <tbody>

        {{-- agrupamos por horario --}}
        @php
            $horarios = $clases->groupBy(function($c){
                return $c->horario->hora_inicio . ' - ' . $c->horario->hora_fin;
            });
        @endphp

        @foreach($horarios as $rango => $clasesPorHora)

        <tr class="border-t">

            {{-- HORARIO IZQUIERDA --}}
            <td class="p-3 font-semibold bg-gray-50">
                {{ $rango }}
            </td>

            {{-- CELDAS POR DÍA --}}
            @foreach($dias as $dia)

                <td class="p-2 align-top">

                    @php
                        $clasesDia = $clasesPorHora->filter(function($c) use ($dia) {
                            return $c->horario->dia == $dia;
                        });
                    @endphp

                    @foreach($clasesDia as $clase)

                        <div class="bg-blue-100 rounded p-2 mb-2 text-sm">

                            <div class="font-bold">
                                {{ $clase->materia->nombre }}
                            </div>

                            <div class="text-gray-700">
                                Grupo: {{ $clase->grupo->nombre }}
                            </div>

                            <div class="text-gray-600">
                                Aula: {{ $clase->aula->nombre }}
                            </div>

                        </div>

                    @endforeach

                </td>

            @endforeach

        </tr>

        @endforeach

    </tbody>

</table>

</div>

@endsection