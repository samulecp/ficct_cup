@extends('layouts.app')

@section('title', 'Editar Grupo')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <form method="POST"
          action="{{ route('grupos.update', $grupo) }}">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">
                Nombre
            </label>

            <input type="text"
                   name="nombre"
                   value="{{ $grupo->nombre }}"
                   class="w-full border rounded p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Periodo
            </label>

            <select name="periodo_id"
                    class="w-full border rounded p-2">

                @foreach($periodos as $periodo)

                    <option value="{{ $periodo->id }}"
                        {{ $grupo->periodo_id == $periodo->id ? 'selected' : '' }}>
                        {{ $periodo->nombre }}
                    </option>

                @endforeach

            </select>

        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">

            Actualizar

        </button>

    </form>

</div>

@endsection