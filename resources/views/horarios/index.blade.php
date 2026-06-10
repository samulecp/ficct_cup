@extends('layouts.app')

@section('title','Horarios')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('horarios.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">

        Nuevo Horario

    </a>

    <form method="GET"
          action="{{ route('horarios.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar día..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

    </form>

</div>

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3">Día</th>

                <th class="p-3">Hora Inicio</th>

                <th class="p-3">Hora Fin</th>

                <th class="p-3">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @foreach($horarios as $horario)

            <tr class="border-t">

                <td class="p-3">
                    {{ $horario->dia }}
                </td>

                <td class="p-3">
                    {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}
                </td>

                <td class="p-3">
                    {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
                </td>

                <td class="p-3 flex gap-2">

                    <a href="{{ route('horarios.edit',$horario) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">

                        Editar

                    </a>

                    <form method="POST"
                          action="{{ route('horarios.destroy',$horario) }}">

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