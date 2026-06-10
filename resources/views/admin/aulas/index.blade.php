@extends('layouts.app')

@section('title','Aulas')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('admin.aulas.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">

        Nueva Aula

    </a>

    <form method="GET"
          action="{{ route('admin.aulas.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar aula..."
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

                <th class="p-3">Nombre</th>

                <th class="p-3">Capacidad</th>

                <th class="p-3">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @foreach($aulas as $aula)

                <tr class="border-t">

                    <td class="p-3">

                        {{ $aula->nombre }}

                    </td>

                    <td class="p-3">

                        {{ $aula->capacidad }}

                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('admin.aulas.edit',$aula) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">

                            Editar

                        </a>

                        <form method="POST"
                              action="{{ route('admin.aulas.destroy',$aula) }}">

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