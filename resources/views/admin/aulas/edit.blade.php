@extends('layouts.app')

@section('title','Editar Aula')

@section('content')

<form method="POST"
      action="{{ route('admin.aulas.update', $aula) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">

        <label class="block mb-1 font-semibold">
            Nombre
        </label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre', $aula->nombre) }}"
               class="w-full border rounded p-2">

        @error('nombre')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div class="mb-4">

        <label class="block mb-1 font-semibold">
            Capacidad
        </label>

        <input type="number"
               name="capacidad"
               value="{{ old('capacidad', $aula->capacidad) }}"
               min="1"
               class="w-full border rounded p-2">

        @error('capacidad')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

    <div class="flex gap-2">

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

            Actualizar

        </button>

        <a href="{{ route('admin.aulas.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">

            Cancelar

        </a>

    </div>

</form>

@endsection