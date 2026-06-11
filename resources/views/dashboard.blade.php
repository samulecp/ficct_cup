@extends('layouts.app')

@section('title', 'FICCT somos todos')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Postulantes</h2>
        <p class="text-3xl font-bold">{{ $postulantes }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Docentes</h2>
        <p class="text-3xl font-bold">{{ $docentes }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Grupos</h2>
        <p class="text-3xl font-bold">{{ $grupos }}</p>
    </div>

</div>

@endsection