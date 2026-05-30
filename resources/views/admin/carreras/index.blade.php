@extends('layouts.app')

@section('title', 'Carreras')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">
        Carreras
    </h1>

    <a href="{{ route('admin.carreras.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">

        Nueva Carrera

    </a>

</div>

@if(session('success'))

    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

        {{ session('success') }}

    </div>

@endif

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">
                    Nombre
                </th>

                <th class="p-3 text-left">
                    Cupo
                </th>

                

                <th class="p-3 text-left">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($carreras as $carrera)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $carrera->nombre }}
                    </td>

                    <td class="p-3">
                        {{ $carrera->cupo }}
                    </td>

                   

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('admin.carreras.edit', $carrera) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">

                            Editar

                        </a>

                        <form method="POST"
      action="{{ route('admin.carreras.destroy', $carrera) }}"
      onsubmit="return confirm('¿Está seguro de eliminar esta carrera?')">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">

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