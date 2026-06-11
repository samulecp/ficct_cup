<h2>Reporte Académico</h2>

<p>Periodo: {{ $request['periodo_id'] ?? 'Todos' }}</p>

<p>Total elementos:</p>
<p>{{ $distribucion['values']->sum() }}</p>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Categoria</th>
            <th>Porcentaje</th>
        </tr>
    </thead>

    <tbody>
        @foreach($distribucion['labels'] as $i => $label)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $distribucion['values'][$i] }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>