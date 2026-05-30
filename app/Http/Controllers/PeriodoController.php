<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Services\LogService;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::all();

        return view(
            'admin.periodos.index',
            compact('periodos')
        );
    }

    public function create()
    {
        return view('admin.periodos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'nota_aprobacion' => 'required|numeric|min:0|max:100',
            'max_alumno_grupo' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $periodo = Periodo::create([
            'nombre' => $request->nombre,
            'nota_aprobacion' => $request->nota_aprobacion,
            'max_alumno_grupo' => $request->max_alumno_grupo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activo' => true,
        ]);

        LogService::registrar(
            'CREAR',
            'PERIODOS',
            'Se creó el período: ' . $periodo->nombre
        );

        return redirect()
            ->route('admin.periodos.index')
            ->with('success', 'Periodo registrado correctamente');
    }

    public function edit(Periodo $periodo)
    {
        return view(
            'admin.periodos.edit',
            compact('periodo')
        );
    }

    public function update(
        Request $request,
        Periodo $periodo
    ) {
        $request->validate([
            'nombre' => 'required|max:255',
            'nota_aprobacion' => 'required|numeric|min:0|max:100',
            'max_alumno_grupo' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $periodo->update([
            'nombre' => $request->nombre,
            'nota_aprobacion' => $request->nota_aprobacion,
            'max_alumno_grupo' => $request->max_alumno_grupo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        LogService::registrar(
            'EDITAR',
            'PERIODOS',
            'Se editó el período: ' . $periodo->nombre
        );

        return redirect()
            ->route('admin.periodos.index')
            ->with('success', 'Periodo actualizado');
    }

    public function destroy(Periodo $periodo)
{
    $periodo->activo = false;

    $periodo->save();

    LogService::registrar(
        'DESACTIVAR',
        'PERIODOS',
        'Se desactivó el período: ' . $periodo->nombre
    );

    return redirect()
        ->route('admin.periodos.index')
        ->with(
            'success',
            'Periodo desactivado correctamente'
        );
}

    public function cambiarEstado(Periodo $periodo)
{
    $periodo->activo = !$periodo->activo;

    $periodo->save();

    LogService::registrar(
        'CAMBIO ESTADO',
        'PERIODOS',
        'Se cambió el estado del período: ' . $periodo->nombre .
        ' a ' . ($periodo->activo ? 'Activo' : 'Inactivo')
    );

    return redirect()
        ->route('admin.periodos.index');
}
}