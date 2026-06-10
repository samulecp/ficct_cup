@extends('layouts.app')

@section('title','Editar Clase')

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
      action="{{ route('clases.update', $clase) }}"
      class="bg-white p-6 rounded shadow">


@csrf
@method('PUT')

<div class="mb-4">

    <label class="block mb-2">
        Grupo
    </label>

    <select name="grupo_id"
            class="w-full border rounded p-2">

        @foreach($grupos as $grupo)

            <option value="{{ $grupo->id }}"
                {{ $clase->grupo_id == $grupo->id ? 'selected' : '' }}>

                {{ $grupo->nombre }}

            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label class="block mb-2">
        Materia
    </label>

    <select name="materia_id"
            class="w-full border rounded p-2">

        @foreach($materias as $materia)

            <option value="{{ $materia->id }}"
                {{ $clase->materia_id == $materia->id ? 'selected' : '' }}>

                {{ $materia->nombre }}

            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label class="block mb-2">
        Docente
    </label>

    <select name="docente_id"
            class="w-full border rounded p-2">

        @foreach($docentes as $docente)

            <option value="{{ $docente->id }}"
                {{ $clase->docente_id == $docente->id ? 'selected' : '' }}>

                {{ $docente->nombre }}

            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label class="block mb-2">
        Aula
    </label>

    <select name="aula_id"
            class="w-full border rounded p-2">

        @foreach($aulas as $aula)

            <option value="{{ $aula->id }}"
                {{ $clase->aula_id == $aula->id ? 'selected' : '' }}>

                {{ $aula->nombre }}

            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label class="block mb-2">
        Horario
    </label>

    <select name="horario_id"
            class="w-full border rounded p-2">

        @foreach($horarios as $horario)

            <option value="{{ $horario->id }}"
                {{ $clase->horario_id == $horario->id ? 'selected' : '' }}>

                {{ $horario->dia }}
                -
                {{ substr($horario->hora_inicio,0,5) }}
                a
                {{ substr($horario->hora_fin,0,5) }}

            </option>

        @endforeach

    </select>

</div>

<div class="flex gap-2">

    <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded">

        Actualizar

    </button>

    <a href="{{ route('clases.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Cancelar

    </a>

</div>


</form>

@endsection
