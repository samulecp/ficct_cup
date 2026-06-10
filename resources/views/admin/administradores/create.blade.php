@extends('layouts.app')

@section('title','Nuevo Administrador')

@section('content')

<form method="POST"
      action="{{ route('admin.administradores.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">
        <label>Nombre</label>
        <input type="text"
               name="nombre"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Correo</label>
        <input type="email"
               name="email"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Contraseña</label>
        <input type="password"
               name="password"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>CI</label>
        <input type="text"
               name="ci"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Teléfono</label>
        <input type="text"
               name="telefono"
               class="w-full border rounded p-2">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Guardar
    </button>

</form>

@endsection