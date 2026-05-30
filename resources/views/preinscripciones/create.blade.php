@extends('layouts.app')

@section('title', 'Nueva Preinscripción')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">

        Nueva Preinscripción

    </h1>

    @if ($errors->any())

        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST"
          action="{{ route('preinscripciones.store') }}">

        @csrf

        @include('preinscripciones._form')

        <button type="submit"
                class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">

            Guardar

        </button>

    </form>

</div>

@endsection