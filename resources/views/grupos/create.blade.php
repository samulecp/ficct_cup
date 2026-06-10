@extends('layouts.app')

@section('title', 'Nuevo Grupo')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <form method="POST"
          action="{{ route('grupos.store') }}">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Nombre
            </label>

            <input type="text"
                   name="nombre"
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

                    <option value="{{ $periodo->id }}">
                        {{ $periodo->nombre }}
                    </option>

                @endforeach

            </select>

        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">

            Guardar

        </button>

    </form>

</div>

@endsection