<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Clase;
use App\Models\Grupo;
use App\Models\Periodo;
use App\Models\PreInscripcion;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $buscar = $request->buscar;

    $calificaciones = Calificacion::with([
        'preinscripcion.postulante',
        'preinscripcion.grupo',
        'clase.materia'
    ])

    ->when($buscar, function ($query) use ($buscar) {

        $query->whereHas(
            'preinscripcion.postulante',
            function ($q) use ($buscar) {

                $q->where(
                    'nombre',
                    'ILIKE',
                    "%{$buscar}%"
                )
                ->orWhere(
                    'ci',
                    'ILIKE',
                    "%{$buscar}%"
                );
            }
        )

        ->orWhereHas(
            'preinscripcion.grupo',
            function ($q) use ($buscar) {

                $q->where(
                    'nombre',
                    'ILIKE',
                    "%{$buscar}%"
                );
            }
        )

        ->orWhereHas(
            'clase.materia',
            function ($q) use ($buscar) {

                $q->where(
                    'nombre',
                    'ILIKE',
                    "%{$buscar}%"
                );
            }
        );
    })

    ->orderBy('id')

    ->get();

    return view(
        'calificaciones.index',
        compact(
            'calificaciones',
            'buscar'
        )
    );
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
    public function show(Calificacion $calificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
    Calificacion $calificacion
)
{
     if(Auth::user()->docente){

        $docente = Auth::user()->docente;

        if(
            $calificacion->clase->docente_id
            !=
            $docente->id
        ){
            abort(403);
        }
    }

    $calificacion->load([
        'preinscripcion.postulante',
        'clase.materia'
    ]);

    return view(
        'calificaciones.edit',
        compact('calificacion')
    );
}

    /**
     * Update the specified resource in storage.
     */
    public function update(
    Request $request,
    Calificacion $calificacion
)
{   
     if(Auth::user()->docente){

        $docente = Auth::user()->docente;

        if(
            $calificacion->clase->docente_id
            !=
            $docente->id
        ){
            abort(403);
        }
    }
    $request->validate([

    'examen1' =>
        'nullable|numeric|min:0|max:30',

    'examen2' =>
        'nullable|numeric|min:0|max:30',

    'examen3' =>
        'nullable|numeric|min:0|max:40',
]);

   $examen1 = $request->filled('examen1')
    ? $request->examen1
    : $calificacion->examen1;

$examen2 = $request->filled('examen2')
    ? $request->examen2
    : $calificacion->examen2;

$examen3 = $request->filled('examen3')
    ? $request->examen3
    : $calificacion->examen3;

$notaFinal =
    $examen1 +
    $examen2 +
    $examen3;

    $calificacion->update([

    'examen1' =>
        $examen1,

    'examen2' =>
        $examen2,

    'examen3' =>
        $examen3,

    'nota_final' =>
        $notaFinal,
]);

    LogService::registrar(
        'ACTUALIZAR',
        'CALIFICACIONES',
        'Se actualizó calificación ID '
        . $calificacion->id
    );

   if(Auth::user()->docente){

    return redirect()
        ->route(
            'docente.calificarClase',
            $calificacion->clase_id
        )
        ->with(
            'success',
            'Calificación actualizada.'
        );
}

return redirect()
    ->route('calificaciones.index')
    ->with(
        'success',
        'Calificación actualizada.'
    );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calificacion $calificacion)
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

    $preinscripciones = PreInscripcion::with(
        'grupo'
    )

    ->where(
        'periodo_id',
        $periodo->id
    )

    ->whereNotNull(
        'grupo_id'
    )

    ->get();

    $creadas = 0;

    foreach (
        $preinscripciones
        as
        $preinscripcion
    ) {

        $materias = Clase::where(
            'grupo_id',
            $preinscripcion->grupo_id
        )

        ->select(
            'materia_id'
        )

        ->distinct()

        ->get();

        foreach (
            $materias
            as
            $materia
        ) {

            $clase = Clase::where(
                'grupo_id',
                $preinscripcion->grupo_id
            )

            ->where(
                'materia_id',
                $materia->materia_id
            )

            ->first();

            $existe = Calificacion::where(
                'pre_inscripcion_id',
                $preinscripcion->id
            )

            ->where(
                'clase_id',
                $clase->id
            )

            ->exists();

            if (!$existe) {

                Calificacion::create([

                    'pre_inscripcion_id' =>
                        $preinscripcion->id,

                    'clase_id' =>
                        $clase->id,

                    'examen1' => 0,

                    'examen2' => 0,

                    'examen3' => 0,

                    'nota_final' => 0,
                ]);

                $creadas++;
            }
        }
    }

    return back()->with(
        'success',
        $creadas .
        ' calificaciones generadas.'
    );
}


 public function misClasesCalificacion()
{
    $docente = Auth::user()->docente;

    $periodoActivo = Periodo::where('activo', true)->first();

    if (!$periodoActivo) {
        return back()->with('error', 'No existe un período activo.');
    }

    $clases = Clase::with(['grupo', 'materia'])
        ->where('docente_id', $docente->id)
        ->whereHas('grupo', function ($q) use ($periodoActivo) {
            $q->where('periodo_id', $periodoActivo->id);
        })
        ->get()
        ->unique(function ($c) {
            return $c->grupo_id . '-' . $c->materia_id;
        })
        ->values();

    return view(
        'docente.calificaciones',
        compact('clases', 'periodoActivo')
    );
}
    

   public function misClases()
{
    $docente = Auth::user()->docente;

    $periodoActivo = Periodo::where('activo', true)->first();

    if (!$periodoActivo) {
        return back()->with('error', 'No existe un periodo activo.');
    }

    $clases = Clase::with([
        'grupo',
        'materia',
        'aula',
        'horario'
    ])
    ->where('docente_id', $docente->id)
    ->whereHas('grupo', function ($q) use ($periodoActivo) {
        $q->where('periodo_id', $periodoActivo->id);
    })

    // 🔥 ORDEN REAL EN BASE DE DATOS
    ->join('horarios', 'clases.horario_id', '=', 'horarios.id')
    ->orderByRaw("CASE horarios.dia
        WHEN 'Lunes' THEN 1
        WHEN 'Martes' THEN 2
        WHEN 'Miércoles' THEN 3
        WHEN 'Jueves' THEN 4
        WHEN 'Viernes' THEN 5
        WHEN 'Sábado' THEN 6
        ELSE 99
    END")
    ->orderBy('horarios.hora_inicio')

    ->select('clases.*')
    ->get();

    return view('docente.mis-clases', compact('clases', 'periodoActivo'));
}
public function calificarClase(
    Clase $clase
)
{
    $docente = Auth::user()->docente;

    $periodoActivo = Periodo::where(
    'activo',
    true
)->first();

if(
    $clase->grupo->periodo_id
    !=
    $periodoActivo->id
){
    abort(403);
}

    $calificaciones = Calificacion::with([
        'preinscripcion.postulante'
    ])

    ->where(
        'clase_id',
        $clase->id
    )

    ->get();

    return view(
        'docente.calificar-clase',
        compact(
            'clase',
            'calificaciones'
        )
    );
}
}

