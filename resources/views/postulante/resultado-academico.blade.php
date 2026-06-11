@extends('layouts.app')

@section('title','Resultado Académico')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">

        Resultado Académico

    </h2>

    <p>
        Promedio:
        <strong>
            {{ $resultado->promedio }}
        </strong>
    </p>

    <p>
        Estado:
        <strong>
            {{ $resultado->estado }}
        </strong>
    </p>

    <p>
        Carrera Asignada:
        <strong>
            {{ $resultado->carrera->nombre ?? 'Sin asignar' }}
        </strong>
    </p>

</div>

@endsection