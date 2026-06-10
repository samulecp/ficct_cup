@extends('layouts.app')

@section('title','Calificaciones')

@section('content')

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3">Grupo</th>

            <th class="p-3">Materia</th>

            <th class="p-3">Acción</th>

        </tr>

    </thead>

    <tbody>

    @foreach($clases as $clase)

        <tr class="border-t">

            <td class="p-3">

                {{ $clase->grupo->nombre }}

            </td>

            <td class="p-3">

                {{ $clase->materia->nombre }}

            </td>

            <td class="p-3">

                <a
                    href="{{ route('docente.calificarClase',$clase) }}"
                    class="bg-blue-600 text-white px-3 py-1 rounded">

                    Calificar

                </a>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>


</div>

@endsection
