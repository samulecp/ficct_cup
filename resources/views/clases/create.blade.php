@extends('layouts.app')

@section('title','Nueva Clase')

@section('content')
@if ($errors->any())

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

        <ul class="list-disc pl-5">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif
<form method="POST"
      action="{{ route('clases.store') }}"
      class="bg-white p-6 rounded shadow">


@csrf

<div class="mb-4">

    <label>Grupo</label>

    <select name="grupo_id"
            class="w-full border rounded p-2">

        @foreach($grupos as $grupo)

            <option value="{{ $grupo->id }}">
                {{ $grupo->nombre }}
            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label>Materia</label>

    <select name="materia_id"
            class="w-full border rounded p-2">

        @foreach($materias as $materia)

            <option value="{{ $materia->id }}">
                {{ $materia->nombre }}
            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label>Docente</label>

    <select name="docente_id"
            class="w-full border rounded p-2">

        @foreach($docentes as $docente)

            <option value="{{ $docente->id }}">
                {{ $docente->user->name }}
            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label>Aula</label>

    <select name="aula_id"
            class="w-full border rounded p-2">

        @foreach($aulas as $aula)

            <option value="{{ $aula->id }}">
                {{ $aula->nombre }}
            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label>Horario</label>

    <select name="horario_id"
            class="w-full border rounded p-2">

        @foreach($horarios as $horario)

            <option value="{{ $horario->id }}">

                {{ $horario->dia }}
                -
                {{ substr($horario->hora_inicio,0,5) }}
                -
                {{ substr($horario->hora_fin,0,5) }}

            </option>

        @endforeach

    </select>

</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">

    Guardar

</button>


</form>

@endsection
