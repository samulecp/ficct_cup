@extends('layouts.app')

@section('title','Editar Calificación')

@section('content')

<form method="POST"
      action="{{ route('calificaciones.update',$calificacion) }}"
      class="bg-white p-6 rounded shadow">


@csrf
@method('PUT')

<div class="mb-4">

    <label>Postulante</label>

    <input type="text"
           readonly
           value="{{ $calificacion->preinscripcion->postulante->nombre }}"
           class="w-full border rounded p-2 bg-gray-100">

</div>

<div class="mb-4">

    <label>Materia</label>

    <input type="text"
           readonly
           value="{{ $calificacion->clase->materia->nombre }}"
           class="w-full border rounded p-2 bg-gray-100">

</div>

<div class="mb-4">

    <label>Examen 1</label>

    <input type="number"
           step="0.01"
           min="0"
           max="100"
           name="examen1"
           value="{{ old('examen1',$calificacion->examen1) }}"
           class="w-full border rounded p-2">

</div>

<div class="mb-4">

    <label>Examen 2</label>

    <input type="number"
           step="0.01"
           min="0"
           max="100"
           name="examen2"
           value="{{ old('examen2',$calificacion->examen2) }}"
           class="w-full border rounded p-2">

</div>

<div class="mb-4">

    <label>Examen 3</label>

    <input type="number"
           step="0.01"
           min="0"
           max="100"
           name="examen3"
           value="{{ old('examen3',$calificacion->examen3) }}"
           class="w-full border rounded p-2">

</div>

<button
    class="bg-green-600 text-white px-4 py-2 rounded">

    Guardar

</button>


</form>

@endsection
