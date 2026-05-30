@extends('layouts.app')

@section('title', 'Operadores')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Operadores</h1>

    <a href="{{ route('admin.operadores.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        Nuevo Operador
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