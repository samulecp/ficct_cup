<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Services\LogService;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $aulas = Aula::when($buscar, function ($query) use ($buscar) {

            $query->where(
                'nombre',
                'ILIKE',
                "%{$buscar}%"
            );

        })->get();

        return view(
            'admin.aulas.index',
            compact('aulas')
        );
    }

    public function create()
    {
        return view('admin.aulas.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nombre' =>
                'required|max:100',

            'capacidad' =>
                'required|integer|min:1',
        ]);

        $aula = Aula::create([

            'nombre' =>
                $request->nombre,

            'capacidad' =>
                $request->capacidad,

            'estado' => true
        ]);

        LogService::registrar(
            'CREAR',
            'AULAS',
            'Se creó aula: ' .
            $aula->nombre
        );

        return redirect()
            ->route('admin.aulas.index')
            ->with(
                'success',
                'Aula creada correctamente.'
            );
    }

    public function edit(Aula $aula)
    {
        return view(
            'admin.aulas.edit',
            compact('aula')
        );
    }

    public function update(
        Request $request,
        Aula $aula
    ) {

        $request->validate([

            'nombre' =>
                'required|max:100',

            'capacidad' =>
                'required|integer|min:1',
        ]);

        $aula->update([

            'nombre' =>
                $request->nombre,

            'capacidad' =>
                $request->capacidad,
        ]);

        LogService::registrar(
            'EDITAR',
            'AULAS',
            'Se editó aula: ' .
            $aula->nombre
        );

        return redirect()
            ->route('admin.aulas.index');
    }

    public function destroy(Aula $aula)
    {
        LogService::registrar(
            'ELIMINAR',
            'AULAS',
            'Se eliminó aula: ' .
            $aula->nombre
        );

        $aula->delete();

        return redirect()
            ->route('admin.aulas.index');
    }
}