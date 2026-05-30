@extends('layouts.app')

@section('title', 'Nuevo Postulante')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">
        Nuevo Postulante
    </h1>

    <form method="POST"
          action="{{ route('admin.postulantes.store') }}">

        @csrf

        @include('admin.postulantes._form')

        <button class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>

    </form>

</div>

@endsection