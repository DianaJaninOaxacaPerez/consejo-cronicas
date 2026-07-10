<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = \App\Models\User::where('correo', $request->correo)
            ->where('estado', 'activo')
            ->first();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'user_no_encontrado');
        }

        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->password,
            'estado' => 'activo',
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'pass_incorrecto');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }
}