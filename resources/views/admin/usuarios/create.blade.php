@extends('layouts.app')

@section('title','Nuevo Usuario')

@section('content')

<form method="POST"
      action="{{ route('admin.usuarios.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">
        <label>Nombre</label>
        <input type="text"
               name="name"
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
        <label>Rol</label>

        <select name="rol"
                class="w-full border rounded p-2">

            @foreach($roles as $rol)

                <option value="{{ $rol->name }}">
                    {{ $rol->name }}
                </option>

            @endforeach

        </select>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">

        Guardar

    </button>

</form>

@endsection