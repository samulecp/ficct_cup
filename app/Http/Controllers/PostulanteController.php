<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use App\Services\LogService;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
        public function index()
{
    $postulantes = Postulante::all();
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
}