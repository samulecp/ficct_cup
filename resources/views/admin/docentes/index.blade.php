@extends('layouts.app')

@section('title','Docentes')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('admin.docentes.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Nuevo Docente
    </a>

    <form method="GET"
          action="{{ route('admin.docentes.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar docente..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

        <a href="{{ route('admin.docentes.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Limpiar
        </a>

    </form>

</div>

<div class="bg-white shadow rounded mt-4 overflow-x-auto">

    <table class="w-full">

        <thead>
            <tr class="bg-gray-100">

                <th class="p-3">Nombre</th>
                <th class="p-3">Correo</th>
                <th class="p-3">CI</th>
                <th class="p-3">Teléfono</th>
                <th class="p-3">Acciones</th>

            </tr>
        </thead>

        <tbody>

        @foreach($docentes as $docente)

            <tr class="border-t">

                <td class="p-3">
                    {{ $docente->user->name }}
                </td>

                <td class="p-3">
                    {{ $docente->user->email }}
                </td>

                <td class="p-3">
                    {{ $docente->ci }}
                </td>

                <td class="p-3">
                    {{ $docente->telefono }}
                </td>

                <td class="p-3 flex gap-2">

                    <a href="{{ route('admin.docentes.edit',$docente) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">

                        Editar

                    </a>

                    <form method="POST"
                          action="{{ route('admin.docentes.destroy',$docente) }}">

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