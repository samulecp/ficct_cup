@extends('layouts.app')

@section('title', 'Operadores')

@section('content')

<div class="flex justify-between items-center mb-4">

    <a href="{{ route('admin.operadores.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        Nuevo Operador
    </a>

    <form method="GET"
          action="{{ route('admin.operadores.index') }}"
          class="flex gap-2">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar operador..."
               class="border rounded px-3 py-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Buscar
        </button>

        <a href="{{ route('admin.operadores.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Limpiar
        </a>

    </form>

</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Nombre</th>
                <th class="p-3 text-left">CI</th>
                <th class="p-3 text-left">Correo</th>
                <th class="p-3 text-left">Estado</th>
                <th class="p-3 text-left">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($operadores as $operador)
                <tr class="border-t">
                    <td class="p-3">{{ $operador->nombre }}</td>
                    <td class="p-3">{{ $operador->ci }}</td>
                    <td class="p-3">{{ $operador->correo }}</td>

                    <td class="p-3">
                        @if($operador->estado)
                            <span class="text-green-600 font-semibold">Activo</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactivo</span>
                        @endif
                    </td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.operadores.edit', $operador) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('admin.operadores.destroy', $operador) }}"
                              onsubmit="return confirm('¿Eliminar operador?')">
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