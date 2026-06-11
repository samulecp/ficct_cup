@extends('layouts.app')

@section('title','Mis Docentes')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Mis Docentes
</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($docentes as $clase)

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex items-center gap-4">

        <div class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold">
            {{ strtoupper(substr($clase->docente->user->name,0,1)) }}
        </div>

        <div>

            <h3 class="font-bold text-lg">
                {{ $clase->docente->user->name }}
            </h3>

            <p class="text-gray-500">
                Docente Universitario
            </p>

        </div>

    </div>

    <hr class="my-4">

    <div class="space-y-2">

        <p>
            <span class="font-semibold">
                Correo:
            </span>

            {{ $clase->docente->user->email }}
        </p>

        @if($clase->docente->telefono)

        <p>
            <span class="font-semibold">
                Teléfono:
            </span>

            {{ $clase->docente->telefono }}
        </p>

        @endif

    </div>

</div>

@endforeach

</div>

@endsection