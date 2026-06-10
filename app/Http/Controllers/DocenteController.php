<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->buscar;

    $docentes = Docente::with('user')

        ->when($buscar, function ($query) use ($buscar) {

            $query->where('ci', 'ILIKE', "%{$buscar}%")

                  ->orWhereHas('user', function ($q) use ($buscar) {

                        $q->where('name', 'ILIKE', "%{$buscar}%");

                  });

        })

        ->get();

    return view('admin.docentes.index',
        compact('docentes'));
}

    public function create()
    {
        return view('admin.docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'ci' => 'required|unique:docentes,ci',
            'telefono' => 'nullable'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('docente');

        $docente = Docente::create([
            'user_id' => $user->id,
            'ci' => $request->ci,
            'telefono' => $request->telefono
        ]);

        LogService::registrar(
            'CREAR',
            'DOCENTES',
            'Se creó docente: '.$user->name
        );

        return redirect()
            ->route('admin.docentes.index')
            ->with('success','Docente creado');
    }

    public function edit(Docente $docente)
    {
        return view('admin.docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$docente->user_id,
            'ci' => 'required|unique:docentes,ci,'.$docente->id,
            'telefono' => 'nullable'
        ]);

        $docente->user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $docente->update([
            'ci' => $request->ci,
            'telefono' => $request->telefono
        ]);

        LogService::registrar(
            'EDITAR',
            'DOCENTES',
            'Se editó docente: '.$docente->user->name
        );

        return redirect()->route('admin.docentes.index');
    }

    public function destroy(Docente $docente)
    {
        LogService::registrar(
            'ELIMINAR',
            'DOCENTES',
            'Se eliminó docente: '.$docente->user->name
        );

        $docente->user->delete();

        return redirect()->route('admin.docentes.index');
    }
}