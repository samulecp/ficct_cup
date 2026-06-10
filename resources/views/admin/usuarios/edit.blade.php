@extends('layouts.app')

@section('title','Editar Usuario')

@section('content')

<form method="POST"
      action="{{ route('admin.usuarios.update',$usuario) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1 font-medium">
            Nombre
        </label>

        <input type="text"
               name="name"
               value="{{ old('name', $usuario->name) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">
            Correo
        </label>

        <input type="email"
               name="email"
               value="{{ old('email', $usuario->email) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">
            Nueva Contraseña
        </label>

        <input type="password"
               name="password"
               class="w-full border rounded p-2">

        <small class="text-gray-500">
            Dejar vacío si no desea cambiar la contraseña.
        </small>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">
            Rol
        </label>

        <select name="rol"
                class="w-full border rounded p-2">

            @foreach($roles as $rol)

                <option value="{{ $rol->name }}"
                    {{ $usuario->roles->first()?->name == $rol->name ? 'selected' : '' }}>

                    {{ ucfirst($rol->name) }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">
            Estado
        </label>

        <select name="estado"
                class="w-full border rounded p-2">

            <option value="1"
                {{ $usuario->estado ? 'selected' : '' }}>
                Activo
            </option>

            <option value="0"
                {{ !$usuario->estado ? 'selected' : '' }}>
                Inactivo
            </option>

        </select>
    </div>

    <div class="flex gap-2">

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded">

            Actualizar

        </button>

        <a href="{{ route('admin.usuarios.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">

            Cancelar

        </a>

    </div>

</form>

@endsection