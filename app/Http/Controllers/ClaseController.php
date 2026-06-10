<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Clase;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\Docente;
use App\Services\LogService;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::with([
            'grupo',
            'materia',
            'horario',
            'docente',
            'aula'
        ])->get();

        return view(
            'clases.index',
            compact('clases')
        );
    }

    public function create()
    {
        return view('clases.create', [

            'grupos' => Grupo::all(),

            'materias' => Materia::all(),

            'horarios' => Horario::all(),

            'docentes' => Docente::all(),

            'aulas' => Aula::all(),

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'grupo_id' =>
            'required|exists:grupos,id',

            'materia_id' =>
            'required|exists:materias,id',

            'horario_id' =>
            'required|exists:horarios,id',

            'docente_id' =>
            'required|exists:docentes,id',

            'aula_id' =>
            'required|exists:aulas,id',
        ]);

        if (
            Clase::where('docente_id', $request->docente_id)
            ->where('horario_id', $request->horario_id)
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'docente_id' =>
                    'El docente ya tiene una clase en ese horario.'
                ])
                ->withInput();
        }

        if (
            Clase::where('aula_id', $request->aula_id)
            ->where('horario_id', $request->horario_id)
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'aula_id' =>
                    'El aula ya está ocupada en ese horario.'
                ])
                ->withInput();
        }

        if (
            Clase::where('grupo_id', $request->grupo_id)
            ->where('horario_id', $request->horario_id)
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'grupo_id' =>
                    'El grupo ya tiene una clase en ese horario.'
                ])
                ->withInput();
        }

        $clase = Clase::create([

            'grupo_id' =>
            $request->grupo_id,

            'materia_id' =>
            $request->materia_id,

            'horario_id' =>
            $request->horario_id,

            'docente_id' =>
            $request->docente_id,

            'aula_id' =>
            $request->aula_id,
        ]);

        LogService::registrar(
            'CREAR',
            'CLASES',
            'Clase creada para grupo: ' .
                $clase->grupo->nombre
        );

        return redirect()
            ->route('clases.index')
            ->with(
                'success',
                'Clase creada correctamente.'
            );
    }



    public function edit(Clase $clase)
    {
        return view('clases.edit', [

            'clase' => $clase,

            'grupos' => Grupo::all(),

            'materias' => Materia::all(),

            'horarios' => Horario::all(),

            'docentes' => Docente::all(),

            'aulas' => Aula::all(),

        ]);
    }

    public function update(
        Request $request,
        Clase $clase
    ) {


        $request->validate([

            'grupo_id' =>
            'required|exists:grupos,id',

            'materia_id' =>
            'required|exists:materias,id',

            'horario_id' =>
            'required|exists:horarios,id',

            'docente_id' =>
            'required|exists:docentes,id',

            'aula_id' =>
            'required|exists:aulas,id',
        ]);

        if (
            Clase::where('docente_id', $request->docente_id)
            ->where('horario_id', $request->horario_id)
            ->where('id', '!=', $clase->id)
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'docente_id' =>
                    'El docente ya tiene una clase en ese horario.'
                ])
                ->withInput();
        }

        if (
            Clase::where('aula_id', $request->aula_id)
            ->where('horario_id', $request->horario_id)
            ->where('id', '!=', $clase->id)
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'aula_id' =>
                    'El aula ya está ocupada en ese horario.'
                ])
                ->withInput();
        }

        if (
            Clase::where('grupo_id', $request->grupo_id)
            ->where('horario_id', $request->horario_id)
            ->where('id', '!=', $clase->id)
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'grupo_id' =>
                    'El grupo ya tiene una clase en ese horario.'
                ])
                ->withInput();
        }

        $clase->update([

            'grupo_id' =>
            $request->grupo_id,

            'materia_id' =>
            $request->materia_id,

            'horario_id' =>
            $request->horario_id,

            'docente_id' =>
            $request->docente_id,

            'aula_id' =>
            $request->aula_id,
        ]);

        LogService::registrar(
            'EDITAR',
            'CLASES',
            'Clase actualizada para grupo: ' .
                $clase->grupo->nombre
        );

        return redirect()
            ->route('clases.index')
            ->with(
                'success',
                'Clase actualizada correctamente.'
            );
    }


    public function destroy(Clase $clase)
    {
        LogService::registrar(
            'ELIMINAR',
            'CLASES',
            'Se eliminó una clase'
        );

        $clase->delete();

        return redirect()
            ->route('clases.index');
    }
}
