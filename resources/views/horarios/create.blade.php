@extends('layouts.app')

@section('title','Nuevo Horario')

@section('content')

<form method="POST"
      action="{{ route('horarios.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">

        <label>Día</label>

        <select name="dia"
                class="w-full border rounded p-2">

            <option value="">Seleccione</option>
            <option>Lunes</option>
            <option>Martes</option>
            <option>Miércoles</option>
            <option>Jueves</option>
            <option>Viernes</option>
            <option>Sábado</option>
            <option>Domingo</option>

        </select>

    </div>

    <div class="mb-4">

        <label>Hora Inicio</label>

        <input type="time"
               name="hora_inicio"
               class="w-full border rounded p-2">

    </div>

    <div class="mb-4">

        <label>Hora Fin</label>

        <input type="time"
               name="hora_fin"
               class="w-full border rounded p-2">

    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">

        Guardar

    </button>

</form>

@endsection