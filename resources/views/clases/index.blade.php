@extends('layouts.app')

@section('title','Clases')

@section('content')

<div class="flex justify-between items-center mb-4">


<a href="{{ route('clases.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">

    Nueva Clase

</a>


</div>

<div class="bg-white rounded shadow overflow-x-auto">


<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3">Grupo</th>

            <th class="p-3">Materia</th>

            <th class="p-3">Docente</th>

            <th class="p-3">Aula</th>

            <th class="p-3">Horario</th>

            <th class="p-3">Acciones</th>

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
                
                {{ $clase->docente->user->name }}
            </td>

            <td class="p-3">
                {{ $clase->aula->nombre }}
            </td>

            <td class="p-3">
                {{ $clase->horario->dia }}
                -
                {{ substr($clase->horario->hora_inicio,0,5) }}
                -
                {{ substr($clase->horario->hora_fin,0,5) }}
            </td>

            <td class="p-3 flex gap-2">

                <a href="{{ route('clases.edit',$clase) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded">

                    Editar

                </a>

                <form method="POST"
                      action="{{ route('clases.destroy',$clase) }}">

                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-3 py-1 rounded">

                        Eliminar

                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>


</div>

@endsection
