<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')->orderBy('id_usuario')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string',
            'cargo'    => 'required|string',
            'correo'   => 'required|email|unique:usuarios,correo',
            'password' => 'required|string|min:8|confirmed',
            'id_rol'   => 'required|exists:roles,id_rol',
        ]);

        $data = $request->only(['nombre', 'cargo', 'correo', 'id_rol']);
        $data['password_hash'] = Hash::make($request->password);
        $data['estado'] = 'activo';

        User::create($data);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $roles = Rol::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre'   => 'required|string',
            'cargo'    => 'required|string',
            'correo'   => 'required|email|unique:usuarios,correo,' . $usuario->id_usuario . ',id_usuario',
            'password' => 'nullable|string|min:8|confirmed',
            'id_rol'   => 'required|exists:roles,id_rol',
        ]);

        $data = $request->only(['nombre', 'cargo', 'correo', 'id_rol']);

        if ($request->filled('password')) {
            $data['password_hash'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        // Baja lógica en vez de borrar, para no perder el historial de quién hizo qué
        $usuario->update(['estado' => 'inactivo']);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario desactivado correctamente.');
    }
}