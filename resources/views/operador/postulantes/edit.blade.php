@extends('layouts.app')

@section('title', 'Editar Postulante')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">
        Editar Postulante
    </h1>

    <form method="POST"
          action="{{ route('admin.postulantes.update', $postulante) }}">

        @csrf
        @method('PUT')

        @include('admin.postulantes._form')

        <button class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>

    </form>

</div>

@endsection