@extends('layouts.app')

@section('title','Editar Horario')

@section('content')

<form method="POST"
      action="{{ route('horarios.update',$horario) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <div class="mb-4">

        <label>Día</label>

        <select name="dia"
                class="w-full border rounded p-2">

            @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'] as $dia)

                <option value="{{ $dia }}"
                    {{ $horario->dia == $dia ? 'selected' : '' }}>
                    {{ $dia }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-4">

        <label>Hora Inicio</label>

        <input type="time"
               name="hora_inicio"
               value="{{ $horario->hora_inicio }}"
               class="w-full border rounded p-2">

    </div>

    <div class="mb-4">

        <label>Hora Fin</label>

        <input type="time"
               name="hora_fin"
               value="{{ $horario->hora_fin }}"
               class="w-full border rounded p-2">

    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">

        Actualizar

    </button>

</form>

@endsection