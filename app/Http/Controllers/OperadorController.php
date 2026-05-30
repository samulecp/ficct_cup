<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Operador;
use App\Models\User;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperadorController extends Controller
{
    public function index()
    {
        $operadores = Operador::with('user')->get();

        return view('admin.operadores.index', compact('operadores'));
    }

    public function create()
    {
        return view('admin.operadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ci' => 'required|unique:operadores,ci',
            'correo' => 'required|email|unique:users,email',
            'telefono' => 'nullable|max:20',
            'password' => 'required|min:6',
        ]);

        // 1. Crear usuario
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        // 2. Asignar rol
        $user->assignRole('operador');

        // 3. Crear operador
        $operador = Operador::create([
            'user_id' => $user->id,
            'ci' => $request->ci,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'estado' => true,
        ]);

        // BITÁCORA
        LogService::registrar(
            'CREAR',
            'OPERADORES',
            'Se creó operador: ' . $operador->nombre
        );

        return redirect()
            ->route('admin.operadores.index')
            ->with('success', 'Operador creado correctamente');
    }

    public function edit(Operador $operador)
    {
        return view('admin.operadores.edit', compact('operador'));
    }

    public function update(Request $request, Operador $operador)
    {
        $request->validate([
            'nombre' => 'required',
            'ci' => 'required|unique:operadores,ci,' . $operador->id,
            'correo' => 'required|email|unique:users,email,' . $operador->user_id,
            'telefono' => 'nullable|max:20',
        ]);

        // actualizar operador
        $operador->update([
            'nombre' => $request->nombre,
            'ci' => $request->ci,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ]);

        // actualizar usuario relacionado
        $operador->user->update([
            'name' => $request->nombre,
            'email' => $request->correo,
        ]);

        // BITÁCORA
        LogService::registrar(
            'EDITAR',
            'OPERADORES',
            'Se editó operador: ' . $operador->nombre
        );

        return redirect()
            ->route('admin.operadores.index')
            ->with('success', 'Operador actualizado correctamente');
    }

    public function destroy(Operador $operador)
    {
        $nombre = $operador->nombre;

        // eliminar usuario (cascade borra operador)
        $operador->user->delete();

        // BITÁCORA
        LogService::registrar(
            'ELIMINAR',
            'OPERADORES',
            'Se eliminó operador: ' . $nombre
        );

        return redirect()
            ->route('admin.operadores.index')
            ->with('success', 'Operador eliminado correctamente');
    }
}