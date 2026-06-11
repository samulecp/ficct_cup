@extends('layouts.app')

@section('title', 'Reporte Académico')

@section('content')

<h1 class="text-2xl font-bold mb-4">Reporte Académico</h1>

{{-- 🔹 FILTROS --}}
<form method="GET"
      class="bg-white p-4 rounded shadow mb-4 grid grid-cols-2 md:grid-cols-3 gap-3">

    <select name="periodo_id" class="border p-2 rounded">
        <option value="">Periodo</option>
        @foreach($periodos as $p)
            <option value="{{ $p->id }}"
                {{ request('periodo_id') == $p->id ? 'selected' : '' }}>
                {{ $p->nombre }}
            </option>
        @endforeach
    </select>

    <select name="estado" class="border p-2 rounded">
        <option value="">Todos</option>
        <option value="APROBADO" {{ request('estado')=='APROBADO'?'selected':'' }}>Aprobados</option>
        <option value="REPROBADO" {{ request('estado')=='REPROBADO'?'selected':'' }}>Reprobados</option>
    </select>

    <select name="tipo" class="border p-2 rounded">
        <option value="carreras">Carreras</option>
        <option value="materias">Materias</option>
        <option value="docentes">Docentes</option>
        <option value="grupos">Grupos</option>
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded col-span-full">
        Generar
    </button>
</form>

{{-- 🔹 EXPORT --}}
<div class="flex gap-2 mb-4">

    <a href="{{ route('reportes.pdf', request()->all()) }}"
       class="bg-red-600 text-white px-4 py-2 rounded">
        PDF
    </a>

    <a href="{{ route('reportes.csv', request()->all()) }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
        CSV
    </a>

</div>

{{-- 🔹 GRAFICO --}}
<div class="flex justify-center bg-white p-6 rounded shadow">
    <div style="width:320px;height:320px;">
        <canvas id="pieChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const data = @json($distribucion);

new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: data.labels,
        datasets: [{
            data: data.values,
            backgroundColor: [
                '#6366F1',
                '#F59E0B',
                '#10B981',
                '#EF4444',
                '#3B82F6',
                '#A855F7'
            ]
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

@endsection