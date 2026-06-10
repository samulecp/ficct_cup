@extends('layouts.app')

@section('title','Reportes Académicos')

@section('content')

<form method="GET" class="grid grid-cols-2 md:grid-cols-5 gap-2 mb-4">

    <select name="docente_id" class="border p-2">
        <option value="">Docente</option>
        @foreach($docentes as $d)
            <option value="{{ $d->id }}">{{ $d->user->name }}</option>
        @endforeach
    </select>

    <select name="grupo_id" class="border p-2">
        <option value="">Grupo</option>
        @foreach($grupos as $g)
            <option value="{{ $g->id }}">{{ $g->nombre }}</option>
        @endforeach
    </select>

    <select name="materia_id" class="border p-2">
        <option value="">Materia</option>
        @foreach($materias as $m)
            <option value="{{ $m->id }}">{{ $m->nombre }}</option>
        @endforeach
    </select>

    <input type="number" name="nota_min" placeholder="Nota min" class="border p-2">
    <input type="number" name="nota_max" placeholder="Nota max" class="border p-2">

    <button class="bg-blue-600 text-white px-3 rounded">Filtrar</button>
</form>

{{-- KPIs --}}
<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="p-4 bg-white shadow rounded text-center">
        <p>Total</p>
        <h2 class="text-xl font-bold">{{ $total }}</h2>
    </div>

    <div class="p-4 bg-green-100 shadow rounded text-center">
        <p>Aprobados</p>
        <h2 class="text-xl font-bold">{{ $porAprobados }}%</h2>
    </div>

    <div class="p-4 bg-red-100 shadow rounded text-center">
        <p>Reprobados</p>
        <h2 class="text-xl font-bold">{{ $porReprobados }}%</h2>
    </div>

</div>

<canvas id="grafico"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('grafico'), {
    type: 'doughnut',
    data: {
        labels: ['Aprobados', 'Reprobados'],
        datasets: [{
            data: [{{ $aprobados }}, {{ $reprobados }}]
        }]
    }
});
</script>

<a href="{{ route('reportes.pdf', request()->all()) }}"
   class="bg-red-600 text-white px-4 py-2 rounded mt-4 inline-block">
    PDF
</a>

@endsection