<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
 use App\Models\Periodo;
use App\Models\PreInscripcion;
use App\Models\ResultadoAcademico;
use Illuminate\Support\Facades\DB;

class ResultadoAcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = ResultadoAcademico::with('preinscripcion.postulante');

    if ($request->filled('buscar')) {

        $query->whereHas('preinscripcion.postulante', function ($q) use ($request) {
            $q->where('nombre', 'ilike', '%' . $request->buscar . '%');
        });
    }

    $resultados = $query->get();

    return view('resultados.index', compact('resultados'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ResultadoAcademico $resultadoAcademico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResultadoAcademico $resultadoAcademico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResultadoAcademico $resultadoAcademico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultadoAcademico $resultadoAcademico)
    {
        //
    }

   

public function generar()
{
    $periodo = Periodo::where(
        'activo',
        true
    )->first();

    if (!$periodo) {

        return back()->with(
            'error',
            'No existe un periodo activo.'
        );
    }

    DB::transaction(function () use ($periodo) {

        ResultadoAcademico::truncate();

        $preinscripciones = PreInscripcion::with([
            'calificaciones'
        ])

        ->where(
            'periodo_id',
            $periodo->id
        )

        ->get();

        foreach ($preinscripciones as $preinscripcion) {

            $calificaciones =
                $preinscripcion->calificaciones;

            if ($calificaciones->count() == 0) {
                continue;
            }

            $aprobado = true;

            foreach ($calificaciones as $calificacion) {

                if (
                    $calificacion->nota_final
                    <
                    $periodo->nota_aprobacion
                ) {
                    $aprobado = false;
                    break;
                }
            }

            $promedio =
                $calificaciones->avg(
                    'nota_final'
                );

            ResultadoAcademico::create([

                'pre_inscripcion_id' =>
                    $preinscripcion->id,

                'promedio' =>
                    round($promedio, 2),

                'estado' =>
                    $aprobado
                    ? 'APROBADO'
                    : 'REPROBADO',

                'carrera_id' =>
                    null
            ]);
        }
    });

    return back()->with(
        'success',
        'Resultados generados correctamente.'
    );
}


public function asignarCarreras()
{
    $resultados = ResultadoAcademico::with([
        'preinscripcion.carreraPrimera',
        'preinscripcion.carreraSegunda'
    ])

    ->where(
        'estado',
        'APROBADO'
    )

    ->orderByDesc(
        'promedio'
    )

    ->get();

    foreach ($resultados as $resultado) {

        $preinscripcion =
            $resultado->preinscripcion;

        $primera =
            $preinscripcion->carreraPrimera;

        $segunda =
            $preinscripcion->carreraSegunda;

        if ($primera) {

            $ocupados = ResultadoAcademico::where(
                'carrera_id',
                $primera->id
            )->count();

            if (
                $ocupados <
                $primera->cupo
            ) {

                $resultado->update([

                    'carrera_id' =>
                        $primera->id

                ]);

                continue;
            }
        }

        if ($segunda) {

            $ocupados = ResultadoAcademico::where(
                'carrera_id',
                $segunda->id
            )->count();

            if (
                $ocupados <
                $segunda->cupo
            ) {

                $resultado->update([

                    'carrera_id' =>
                        $segunda->id

                ]);
            }
        }
    }

    return back()->with(
        'success',
        'Carreras asignadas correctamente.'
    );
}

}
