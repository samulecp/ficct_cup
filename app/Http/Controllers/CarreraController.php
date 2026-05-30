<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Carrera;
use App\Services\LogService;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Listar carreras
     */
    public function index()
    {
        $carreras = Carrera::all();

        return view(
            'admin.carreras.index',
            compact('carreras')
        );
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        return view('admin.carreras.create');
    }

    /**
     * Guardar
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'cupo' => 'required|integer|min:1',
        ]);

        Carrera::create([
            'nombre' => $request->nombre,
            'cupo' => $request->cupo,
            
        ]);
        LogService::registrar(
            'CREAR',
            'CARRERAS',
            'Se creó la carrera: ' . $request->nombre
        );

        return redirect()
            ->route('admin.carreras.index')
            ->with(
                'success',
                'Carrera registrada correctamente'
            );
    }

    /**
     * Editar
     */
    public function edit(Carrera $carrera)
    {
        return view(
            'admin.carreras.edit',
            compact('carrera')
        );
    }

    /**
     * Actualizar
     */
    public function update(
        Request $request,
        Carrera $carrera
    ) {
        $request->validate([
            'nombre' => 'required|max:255',
            'cupo' => 'required|integer|min:1',
        ]);

        $carrera->update([
            'nombre' => $request->nombre,
            'cupo' => $request->cupo,
        ]);
        LogService::registrar(
    'EDITAR',
    'CARRERAS',
    'Se editó la carrera: ' . $carrera->nombre
);

        return redirect()
            ->route('admin.carreras.index')
            ->with(
                'success',
                'Carrera actualizada'
            );
    }

    /**
     * Activar / desactivar
     */
    public function destroy(Carrera $carrera)
    {
        $carrera->delete();

        
    LogService::registrar(
    'ELIMINAR',
    'CARRERAS',
    'Se eliminó la carrera: ' . $carrera->nombre
);
        return redirect()
            ->route('admin.carreras.index')
            ->with(
                'success',
                'Carrera eliminada'
            );
    }
}
