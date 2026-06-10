@extends('layouts.app')

@section('title','Editar Administrador')

@section('content')

<form method="POST"
      action="{{ route('admin.administradores.update', $administrador) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1">Nombre</label>
        <input type="text"
               name="nombre"
               value="{{ old('nombre', $administrador->user->name) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Correo</label>
        <input type="email"
               name="email"
               value="{{ old('email', $administrador->user->email) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">CI</label>
        <input type="text"
               name="ci"
               value="{{ old('ci', $administrador->ci) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Teléfono</label>
        <input type="text"
               name="telefono"
               value="{{ old('telefono', $administrador->telefono) }}"
               class="w-full border rounded p-2">
    </div>

    <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded">
        Actualizar
    </button>

    <a href="{{ route('admin.administradores.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
        Cancelar
    </a>

</form>

@endsection