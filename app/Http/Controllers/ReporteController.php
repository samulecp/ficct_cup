<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Periodo;

use App\Models\PreInscripcion;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function academico(Request $request)
{
    $periodos = Periodo::all();

    $distribucion = $this->getDistribucion($request);

    return view('reportes.academico', compact(
        'periodos',
        'distribucion'
    ));
}


private function getDistribucion(Request $request)
{
    $query = PreInscripcion::with([
        'resultadoAcademico',
        'grupo.clases.materia',
        'grupo.clases.docente.user',
        'carreraPrimera'
    ]);

    if ($request->periodo_id) {
        $query->where('periodo_id', $request->periodo_id);
    }

    $data = $query->get();

    if ($request->estado == 'APROBADO') {
        $data = $data->filter(fn($p) =>
            optional($p->resultadoAcademico)->estado === 'APROBADO'
        );
    }

    if ($request->estado == 'REPROBADO') {
        $data = $data->filter(fn($p) =>
            optional($p->resultadoAcademico)->estado === 'REPROBADO'
        );
    }

    $total = max($data->count(), 1);

    switch ($request->tipo) {

        case 'carreras':
            $grouped = $data->groupBy(fn($p) =>
                optional($p->carreraPrimera)->nombre ?? 'Sin carrera'
            );
            break;

        case 'grupos':
            $grouped = $data->groupBy(fn($p) =>
                optional($p->grupo)->nombre ?? 'Sin grupo'
            );
            break;

        case 'materias':
            $grouped = $data->flatMap(fn($p) =>
                $p->grupo->clases->map(fn($c) => $c->materia->nombre ?? 'Sin materia')
            )->groupBy(fn($x) => $x);
            break;

        case 'docentes':
            $grouped = $data->flatMap(fn($p) =>
                $p->grupo->clases->map(fn($c) => $c->docente->user->name ?? 'Sin docente')
            )->groupBy(fn($x) => $x);
            break;

        default:
            $grouped = collect(['Total' => $data]);
    }

    return [
        'labels' => $grouped->keys()->values(),
        'values' => $grouped->map(fn($g) =>
            round($g->count() / $total * 100, 2)
        )->values()
    ];
}



public function pdf(Request $request)
{
    $periodos = Periodo::all();

    $distribucion = $this->getDistribucion($request);

    return \Barryvdh\DomPDF\Facade\Pdf::loadView('reportes.pdf', [
        'periodos' => $periodos,
        'distribucion' => $distribucion,
        'request' => $request->all()
    ])->stream('reporte.pdf');
}

public function csv(Request $request)
{
    $data = $this->getDistribucion($request);

    $csv = "Categoria,Porcentaje\n";

    foreach ($data['labels'] as $i => $label) {
        $csv .= "{$label},{$data['values'][$i]}\n";
    }

    return response($csv)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename=reporte.csv');
}
}