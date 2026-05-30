@extends('layouts.app')

@section('title', 'Editar Operador')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Editar Operador</h1>

    <form method="POST" action="{{ route('admin.operadores.update', $operador) }}">
        @csrf
        @method('PUT')

        @include('admin.operadores._form')

        <button class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>
    </form>

</div>

@endsection