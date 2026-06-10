@extends('layouts.app')

@section('title','Editar Materia')

@section('content')

<form method="POST"
      action="{{ route('admin.materias.update',$materia) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">

        <label>Nombre</label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre',$materia->nombre) }}"
               class="w-full border rounded p-2">

    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">

        Actualizar

    </button>

</form>

@endsection