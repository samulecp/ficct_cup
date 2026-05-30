<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Mostrar lista de usuarios
     */
    public function index()
    {
        $usuarios = User::with('roles')->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario edición
     */
    public function edit(User $usuario)
    {
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rol' => 'required'
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Cambiar rol
        $usuario->syncRoles([$request->rol]);

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Desactivar usuario
     */
    public function destroy(User $usuario)
    {
        $usuario->estado = false;

        $usuario->save();

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario desactivado');
    }
}