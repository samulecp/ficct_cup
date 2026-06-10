<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Services\LogService;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $horarios = Horario::when($buscar, function ($query) use ($buscar) {

            $query->where(
                'dia',
                'ILIKE',
                "%{$buscar}%"
            );

        })->get();

        return view(
            'horarios.index',
            compact('horarios')
        );
    }

    public function create()
    {
        return view('horarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $horario = Horario::create([
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        LogService::registrar(
            'CREAR',
            'HORARIOS',
            'Se creó horario: ' .
            $horario->dia
        );

        return redirect()
            ->route('horarios.index');
    }

    public function edit(Horario $horario)
    {
        return view(
            'horarios.edit',
            compact('horario')
        );
    }

    public function update(
        Request $request,
        Horario $horario
    ) {
        $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $horario->update([
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        LogService::registrar(
            'EDITAR',
            'HORARIOS',
            'Se editó horario: ' .
            $horario->dia
        );

        return redirect()
            ->route('horarios.index');
    }

    public function destroy(Horario $horario)
    {
        LogService::registrar(
            'ELIMINAR',
            'HORARIOS',
            'Se eliminó horario: ' .
            $horario->dia
        );

        $horario->delete();

        return redirect()
            ->route('horarios.index');
    }
}