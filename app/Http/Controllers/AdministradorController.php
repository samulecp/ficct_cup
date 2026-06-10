<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\User;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->buscar;

    $administradores = Administrador::with('user')

        ->when($buscar, function ($query) use ($buscar) {

            $query->where('ci', 'ILIKE', "%{$buscar}%")

                  ->orWhereHas('user', function ($q) use ($buscar) {

                        $q->where('name', 'ILIKE', "%{$buscar}%");

                  });

        })

        ->get();

    return view('admin.administradores.index',
        compact('administradores'));
}

    public function create()
    {
        return view('admin.administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'ci' => 'required|unique:administradores,ci',
            'telefono' => 'nullable'
        ]);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('administrador');

        Administrador::create([
            'user_id' => $user->id,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'estado' => true
        ]);

        LogService::registrar(
            'CREAR',
            'ADMINISTRADORES',
            'Se creó administrador: '.$user->name
        );

        return redirect()->route('admin.administradores.index');
    }

    public function edit(Administrador $administradore)
    {
        return view('admin.administradores.edit', [
            'administrador' => $administradore
        ]);
    }

    public function update(Request $request, Administrador $administradore)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email,'.$administradore->user_id,
            'ci' => 'required|unique:administradores,ci,'.$administradore->id,
            'telefono' => 'nullable'
        ]);

        $administradore->user->update([
            'name' => $request->nombre,
            'email' => $request->email
        ]);

        $administradore->update([
            'ci' => $request->ci,
            'telefono' => $request->telefono
        ]);

        LogService::registrar(
            'EDITAR',
            'ADMINISTRADORES',
            'Se actualizó administrador: '.$administradore->user->name
        );

        return redirect()->route('admin.administradores.index');
    }

    public function destroy(Administrador $administradore)
    {
        $nombre = $administradore->user->name;

        $administradore->user->delete();

        LogService::registrar(
            'ELIMINAR',
            'ADMINISTRADORES',
            'Se eliminó administrador: '.$nombre
        );

        return redirect()->route('admin.administradores.index');
    }
}