<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Periodo;
use Illuminate\Http\Request;
use App\Services\LogService;
use App\Models\Clase;
use App\Models\Calificacion;
use App\Models\PreInscripcion;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with('periodo')
            ->latest()
            ->paginate(10);

        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $periodos = Periodo::all();

        return view('grupos.create', compact('periodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'periodo_id' => 'required|exists:periodos,id',
        ]);

        $grupo = Grupo::create($request->all());

        LogService::registrar(
            'CREAR',
            'GRUPOS',
            'Se creó grupo: ' . $grupo->nombre
        );

        return redirect()
            ->route('grupos.index')
            ->with('success', 'Grupo creado correctamente');
    }
    public function edit(Grupo $grupo)
    {
        $periodos = Periodo::all();

        return view(
            'grupos.edit',
            compact('grupo', 'periodos')
        );
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'periodo_id' => 'required|exists:periodos,id',
        ]);

        $grupo->update($request->all());

        LogService::registrar(
            'ACTUALIZAR',
            'GRUPOS',
            'Se actualizó grupo: ' . $grupo->nombre
        );

        return redirect()
            ->route('grupos.index')
            ->with('success', 'Grupo actualizado');
    }

    public function destroy(Grupo $grupo)
    {
        $nombre = $grupo->nombre;

        $grupo->delete();

        LogService::registrar(
            'ELIMINAR',
            'GRUPOS',
            'Se eliminó grupo: ' . $nombre
        );

        return redirect()
            ->route('grupos.index')
            ->with('success', 'Grupo eliminado');
    }



    public function generar()
{
    $preinscripciones = PreInscripcion::whereNotNull(
        'grupo_id'
    )->get();

    foreach ($preinscripciones as $pre) {

        $clases = Clase::where(
            'grupo_id',
            $pre->grupo_id
        )->get();

        foreach ($clases as $clase) {

            Calificacion::firstOrCreate(

                [
                    'pre_inscripcion_id' => $pre->id,
                    'clase_id' => $clase->id,
                ],

                [
                    'examen1' => 0,
                    'examen2' => 0,
                    'examen3' => 0,
                    'nota_final' => 0,
                ]
            );
        }
    }

    LogService::registrar(
        'GENERAR',
        'CALIFICACIONES',
        'Se generaron calificaciones automáticamente'
    );

    return redirect()
        ->route('calificaciones.index')
        ->with(
            'success',
            'Calificaciones generadas correctamente.'
        );
}

public function asignarAutomaticamente()
{
    $periodo = Periodo::where(
        'activo',
        true
    )->first();

    if(!$periodo){

        return back()->with(
            'error',
            'No existe un periodo activo.'
        );
    }

    $grupos = Grupo::where(
        'periodo_id',
        $periodo->id
    )
    ->orderBy('nombre')
    ->get();

    if($grupos->isEmpty()){

        return back()->with(
            'error',
            'No existen grupos.'
        );
    }

    $preinscripciones = PreInscripcion::with(
        'postulante'
    )
    ->where(
        'periodo_id',
        $periodo->id
    )
    ->whereNull('grupo_id')
    ->get()
    ->sortBy(
        fn($p) => $p->postulante->nombre
    )
    ->values();

    $maximo = $periodo->max_alumno_grupo;

    $contador = [];

    foreach($grupos as $grupo){

        $contador[$grupo->id] =
            PreInscripcion::where(
                'grupo_id',
                $grupo->id
            )->count();
    }

    foreach($preinscripciones as $pre){

        foreach($grupos as $grupo){

            if(
                $contador[$grupo->id]
                < $maximo
            ){

                $pre->update([

                    'grupo_id' =>
                        $grupo->id
                ]);

                $contador[$grupo->id]++;

                break;
            }
        }
    }

    LogService::registrar(
        'ASIGNAR',
        'GRUPOS',
        'Asignación automática de grupos'
    );

    return back()->with(
        'success',
        'Postulantes asignados correctamente.'
    );
}
}
