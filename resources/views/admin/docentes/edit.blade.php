@extends('layouts.app')

@section('title','Editar Docente')

@section('content')

<form method="POST"
      action="{{ route('admin.docentes.update', $docente) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Nombre
        </label>

        <input type="text"
               name="name"
               value="{{ old('name', $docente->user->name) }}"
               class="w-full border rounded p-2">

        @error('name')
            <p class="text-red-500 text-sm">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Correo
        </label>

        <input type="email"
               name="email"
               value="{{ old('email', $docente->user->email) }}"
               class="w-full border rounded p-2">

        @error('email')
            <p class="text-red-500 text-sm">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            CI
        </label>

        <input type="text"
               name="ci"
               value="{{ old('ci', $docente->ci) }}"
               class="w-full border rounded p-2">

        @error('ci')
            <p class="text-red-500 text-sm">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Teléfono
        </label>

        <input type="text"
               name="telefono"
               value="{{ old('telefono', $docente->telefono) }}"
               class="w-full border rounded p-2">

        @error('telefono')
            <p class="text-red-500 text-sm">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="flex gap-2">

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

            Actualizar

        </button>

        <a href="{{ route('admin.docentes.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">

            Cancelar

        </a>

    </div>

</form>

@endsection