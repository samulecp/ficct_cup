<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Periodo;
use App\Models\Materia;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $periodo = Periodo::where('activo', true)->first();

        // ======================
        // QUERY BASE
        // ======================
        $query = Calificacion::with([
            'preinscripcion',
            'clase.docente.user',
            'clase.grupo',
            'clase.materia',
            'preinscripcion.periodo'
        ]);

        // ======================
        // FILTROS (IMPORTANTE: AQUÍ TODO ANTES DEL GET)
        // ======================

        if ($request->periodo_id) {
            $query->whereHas('preinscripcion', fn($q) =>
                $q->where('periodo_id', $request->periodo_id)
            );
        }

        if ($request->docente_id) {
            $query->whereHas('clase', fn($q) =>
                $q->where('docente_id', $request->docente_id)
            );
        }

        if ($request->grupo_id) {
            $query->whereHas('clase', fn($q) =>
                $q->where('grupo_id', $request->grupo_id)
            );
        }

        if ($request->materia_id) {
            $query->whereHas('clase', fn($q) =>
                $q->where('materia_id', $request->materia_id)
            );
        }

        if ($request->nota_min) {
            $query->where('nota_final', '>=', $request->nota_min);
        }

        if ($request->nota_max) {
            $query->where('nota_final', '<=', $request->nota_max);
        }

        $calificaciones = $query->get();

        // ======================
        // KPIs BASE
        // ======================
        $total = $calificaciones->count();

        $notaAprobacion = $periodo?->nota_aprobacion ?? 51;

        $aprobados = $calificaciones->where('nota_final', '>=', $notaAprobacion)->count();
        $reprobados = $calificaciones->where('nota_final', '<', $notaAprobacion)->count();

        $porAprobados = $total ? round($aprobados * 100 / $total, 2) : 0;
        $porReprobados = $total ? round($reprobados * 100 / $total, 2) : 0;

        // ======================
        // DROPDOWNS (NUNCA VACÍOS)
        // ======================
        return view('reportes.index', [
            'total' => $total,
            'aprobados' => $aprobados,
            'reprobados' => $reprobados,
            'porAprobados' => $porAprobados,
            'porReprobados' => $porReprobados,

            'docentes' => Docente::with('user')->get(),
            'grupos' => Grupo::all(),
            'periodos' => Periodo::all(),
            'materias' => Materia::all(),

            'request' => $request
        ]);
    }

    public function pdf(Request $request)
    {
        $data = $this->index($request)->getData();

        $pdf = Pdf::loadView('reportes.pdf', $data);

        return $pdf->stream('reporte.pdf'); // o download()
    }
}