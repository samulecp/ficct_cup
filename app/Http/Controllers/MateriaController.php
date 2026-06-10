<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Services\LogService;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $materias = Materia::when($buscar, function ($query) use ($buscar) {

            $query->where(
                'nombre',
                'ILIKE',
                "%{$buscar}%"
            );

        })->get();

        return view(
            'admin.materias.index',
            compact('materias')
        );
    }

    public function create()
    {
        return view('admin.materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100'
        ]);

        $materia = Materia::create([
            'nombre' => $request->nombre
        ]);

        LogService::registrar(
            'CREAR',
            'MATERIAS',
            'Se creó materia: ' . $materia->nombre
        );

        return redirect()
            ->route('admin.materias.index');
    }

    public function edit(Materia $materia)
    {
        return view(
            'admin.materias.edit',
            compact('materia')
        );
    }

    public function update(
        Request $request,
        Materia $materia
    ) {

        $request->validate([
            'nombre' => 'required|max:100'
        ]);

        $materia->update([
            'nombre' => $request->nombre
        ]);

        LogService::registrar(
            'EDITAR',
            'MATERIAS',
            'Se editó materia: ' . $materia->nombre
        );

        return redirect()
            ->route('admin.materias.index');
    }

    public function destroy(Materia $materia)
    {
        LogService::registrar(
            'ELIMINAR',
            'MATERIAS',
            'Se eliminó materia: ' . $materia->nombre
        );

        $materia->delete();

        return redirect()
            ->route('admin.materias.index');
    }
}