@extends('layouts.app')

@section('title','Administradores')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('admin.administradores.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Nuevo Administrador
    </a>

    <form method="GET"
          action="{{ route('admin.administradores.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar administrador..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

        <a href="{{ route('admin.administradores.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Limpiar
        </a>

    </form>

</div>

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>
            <th class="p-3">Nombre</th>
            <th class="p-3">Correo</th>
            <th class="p-3">CI</th>
            <th class="p-3">Teléfono</th>
            <th class="p-3">Acciones</th>
        </tr>

    </thead>

    <tbody>

        @foreach($administradores as $administrador)

        <tr class="border-b">

            <td class="p-3">
                {{ $administrador->user->name }}
            </td>

            <td class="p-3">
                {{ $administrador->user->email }}
            </td>

            <td class="p-3">
                {{ $administrador->ci }}
            </td>

            <td class="p-3">
                {{ $administrador->telefono }}
            </td>

            <td class="p-3 flex gap-2">

                <a href="{{ route('admin.administradores.edit',$administrador) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded">

                    Editar

                </a>

                <form method="POST"
                      action="{{ route('admin.administradores.destroy',$administrador) }}">

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