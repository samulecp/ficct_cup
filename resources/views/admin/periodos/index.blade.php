@extends('layouts.app')

@section('title', 'Periodos')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">
        Periodos
    </h1>

    <a href="{{ route('admin.periodos.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">

        Nuevo Periodo

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded shadow overflow-x-auto">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Nombre</th>
<th class="p-3">Nota</th>
<th class="p-3">Máx. Grupo</th>
<th class="p-3">Inicio</th>
<th class="p-3">Fin</th>
<th class="p-3">Estado</th>
<th class="p-3">Acciones</th>

</tr>

</thead>

<tbody>

@foreach($periodos as $periodo)

<tr class="border-t">

<td class="p-3">{{ $periodo->nombre }}</td>
<td class="p-3">{{ $periodo->nota_aprobacion }}</td>
<td class="p-3">{{ $periodo->max_alumno_grupo }}</td>
<td class="p-3">{{ $periodo->fecha_inicio }}</td>
<td class="p-3">{{ $periodo->fecha_fin }}</td>

<td class="p-3">

@if($periodo->activo)

<span class="bg-green-100 text-green-700 px-2 py-1 rounded">
Activo
</span>

@else

<span class="bg-red-100 text-red-700 px-2 py-1 rounded">
Inactivo
</span>

@endif

<td class="p-3">

    <div class="flex gap-2">

        <a href="{{ route('admin.periodos.edit', $periodo) }}"
           class="bg-yellow-500 text-white px-3 py-1 rounded">
            Editar
        </a>

        <form method="POST"
              action="{{ route('admin.periodos.estado', $periodo) }}">

            @csrf
            @method('PATCH')

            <button type="submit"
    class="{{ $periodo->activo
        ? 'bg-red-600 text-white px-3 py-1 rounded'
        : 'bg-green-600 text-white px-3 py-1 rounded' }}">

    {{ $periodo->activo ? 'Desactivar' : 'Activar' }}

</button>

        </form>

    </div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection