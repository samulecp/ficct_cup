@extends('layouts.app')

@section('title','Usuarios')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('admin.usuarios.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Nuevo Usuario
    </a>

    <form method="GET"
          action="{{ route('admin.usuarios.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar usuario..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

        <a href="{{ route('admin.usuarios.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Limpiar
        </a>

    </form>

</div>

<div class="bg-white rounded shadow mt-4 overflow-x-auto">

<table class="w-full">

    <thead class="bg-gray-200">

        <tr>
            <th class="p-3">Nombre</th>
            <th class="p-3">Correo</th>
            <th class="p-3">Rol</th>
            <th class="p-3">Estado</th>
            <th class="p-3">Acciones</th>
        </tr>

    </thead>

    <tbody>

        @foreach($usuarios as $usuario)

        <tr class="border-b">

            <td class="p-3">
                {{ $usuario->name }}
            </td>

            <td class="p-3">
                {{ $usuario->email }}
            </td>

            <td class="p-3">
                {{ $usuario->roles->first()?->name }}
            </td>

            <td class="p-3">
                {{ $usuario->estado ? 'Activo' : 'Inactivo' }}
            </td>

            <td class="p-3 flex gap-2">

                <a href="{{ route('admin.usuarios.edit',$usuario) }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded">
                    Editar
                </a>

                <form method="POST"
                      action="{{ route('admin.usuarios.destroy',$usuario) }}">

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