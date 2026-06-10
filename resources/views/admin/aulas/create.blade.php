@extends('layouts.app')

@section('title','Nueva Aula')

@section('content')

<form method="POST"
      action="{{ route('admin.aulas.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">

        <label>Nombre</label>

        <input type="text"
               name="nombre"
               class="w-full border rounded p-2">

    </div>

    <div class="mb-4">

        <label>Capacidad</label>

        <input type="number"
               name="capacidad"
               class="w-full border rounded p-2">

    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">

        Guardar

    </button>

</form>

@endsection