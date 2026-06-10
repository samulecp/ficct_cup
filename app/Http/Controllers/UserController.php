<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->buscar;

    $usuarios = User::when($buscar, function ($query) use ($buscar) {

        $query->where('name', 'ILIKE', "%{$buscar}%")
              ->orWhere('email', 'ILIKE', "%{$buscar}%");

    })->get();

    return view('admin.usuarios.index', compact('usuarios'));
}

    public function create()
    {
        $roles = Role::all();

        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'rol' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado' => true,
        ]);

        $user->assignRole($request->rol);

        LogService::registrar(
            'CREAR',
            'USUARIOS',
            'Se creó el usuario: ' . $user->name
        );

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario creado');
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();

        return view('admin.usuarios.edit', compact(
            'usuario',
            'roles'
        ));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'rol' => 'required',
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $usuario->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $usuario->syncRoles([$request->rol]);

        LogService::registrar(
            'ACTUALIZAR',
            'USUARIOS',
            'Se actualizó el usuario: ' . $usuario->name
        );

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado');
    }

    public function destroy(User $usuario)
    {
        $nombre = $usuario->name;

        $usuario->delete();

        LogService::registrar(
            'ELIMINAR',
            'USUARIOS',
            'Se eliminó el usuario: ' . $nombre
        );

        return redirect()
            ->route('admin.usuarios.index');
    }
}