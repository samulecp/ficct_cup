@extends('layouts.app')

@section('title', 'Postulantes')

@section('content')

<div class="flex justify-between items-center mb-4">

    

    <form method="GET"
          action="{{ route('admin-postulantes.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar postulante..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

        <a href="{{ route('admin-postulantes.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Limpiar
        </a>

    </form>

</div>

<div class="bg-white rounded shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">CI</th>
                <th class="p-3 text-left">Nombre</th>
                <th class="p-3 text-left">Correo</th>
                <th class="p-3 text-left">Teléfono</th>
                <th class="p-3 text-left">RUDE</th>
                <th class="p-3 text-left">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @foreach($postulantes as $postulante)

                <tr class="border-t">

                    <td class="p-3">{{ $postulante->ci }}</td>
                    <td class="p-3">{{ $postulante->nombre }}</td>
                    <td class="p-3">{{ $postulante->correo }}</td>
                    <td class="p-3">{{ $postulante->telefono }}</td>
                    <td class="p-3">{{ $postulante->rude }}</td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('admin-postulantes.edit', $postulante) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">

                            Editar

                        </a>

                        <form method="POST"
                              action="{{ route('admin-postulantes.destroy', $postulante) }}"
                              onsubmit="return confirm('¿Está seguro de eliminar este postulante?')">

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