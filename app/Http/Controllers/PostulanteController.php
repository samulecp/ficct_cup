<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Clase;
use App\Models\Periodo;
use App\Models\Postulante;
use App\Models\PreInscripcion;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostulanteController extends Controller
{
       public function index(Request $request)
{
    $buscar = $request->buscar;

    $postulantes = Postulante::when($buscar, function ($query) use ($buscar) {

        $query->where('nombre', 'ILIKE', "%{$buscar}%")
              ->orWhere('ci', 'ILIKE', "%{$buscar}%");

    })->get();

    return view('postulante.index', compact('postulantes'));
}

    public function edit(Postulante $postulante)
    {
        return view('postulante.edit', compact('postulante'));
    }

    public function update(
        Request $request,
        Postulante $postulante
    ) {
        $request->validate([
            'ci' => 'required|unique:postulantes,ci,' . $postulante->id,
            'nombre' => 'required|max:255',
            'correo' => 'required|email|unique:postulantes,correo,' . $postulante->id,
            'telefono' => 'nullable|max:20',
            'rude' => 'nullable|max:255',
        ]);

        $postulante->update([
            'ci' => $request->ci,
            'extension' => $request->extension,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'rude' => $request->rude,
        ]);

        LogService::registrar(
            'EDITAR',
            'POSTULANTES',
            'Se editó el postulante: ' . $postulante->nombre
        );

        return redirect()
            ->route('postulante.index')
            ->with('success', 'Postulante actualizado');
    }

    public function destroy(Postulante $postulante)
    {
        $nombre = $postulante->nombre;

        $postulante->delete();

        LogService::registrar(
            'ELIMINAR',
            'POSTULANTES',
            'Se eliminó el postulante: ' . $nombre
        );

        return redirect()
            ->route('postulante.index')
            ->with('success', 'Postulante eliminado');
    }


    public function misClases()
{
    $periodoActivo = Periodo::where(
        'activo',
        true
    )->first();

    if (!$periodoActivo) {

        return back()->with(
            'error',
            'No existe un periodo activo.'
        );
    }

    $postulante = Auth::user()->postulante;

    $preinscripcion = PreInscripcion::where(
        'postulante_id',
        $postulante->id
    )
    ->where(
        'periodo_id',
        $periodoActivo->id
    )
    ->first();

    if (
        !$preinscripcion ||
        !$preinscripcion->grupo_id
    ) {

        return back()->with(
            'error',
            'No tienes grupo asignado.'
        );
    }

    $clases = Clase::with([
        'materia',
        'docente.user',
        'aula',
        'horario'
    ])

    ->where(
        'grupo_id',
        $preinscripcion->grupo_id
    )

    ->orderBy('materia_id')

    ->get();

    return view(
        'postulante.mis-clases',
        compact(
            'clases',
            'periodoActivo'
        )
    );
}

public function misCalificaciones()
{
    $periodoActivo = Periodo::where(
        'activo',
        true
    )->first();

    if (!$periodoActivo) {

        return back()->with(
            'error',
            'No existe un periodo activo.'
        );
    }

    $postulante = Auth::user()->postulante;

    $preinscripcion = PreInscripcion::where(
        'postulante_id',
        $postulante->id
    )
    ->where(
        'periodo_id',
        $periodoActivo->id
    )
    ->first();

    if (!$preinscripcion) {

        return back()->with(
            'error',
            'No tiene preinscripción.'
        );
    }

    $calificaciones = Calificacion::with([
        'clase.materia'
    ])

    ->where(
        'pre_inscripcion_id',
        $preinscripcion->id
    )

    ->get();

    return view(
        'postulante.mis-calificaciones',
        compact(
            'calificaciones',
            'periodoActivo'
        )
    );
}
}