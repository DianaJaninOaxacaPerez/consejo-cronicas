<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\RegistroEvento;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function form()
    {
        $mesas = Mesa::orderBy('id_mesa')->get();
        return view('evento-confirmar', compact('mesas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:150',
            'telefono' => 'required|string|max:20',
            'id_mesa'  => 'required|exists:mesas_trabajo,id_mesa',
        ]);

        $yaExiste = RegistroEvento::where('nombre', $request->nombre)
            ->where('telefono', $request->telefono)
            ->exists();

        if ($yaExiste) {
            return back()->withInput()
                ->with('error', 'Ya existe un registro con ese nombre y teléfono.');
        }

        $registro = RegistroEvento::create([
            'nombre'         => $request->nombre,
            'telefono'       => $request->telefono,
            'id_mesa'        => $request->id_mesa,
            'fecha_registro' => now(),
        ]);

        return redirect()->route('evento.confirmado', $registro->id_registro);
    }

    public function confirmado(RegistroEvento $registro)
    {
        return view('evento-confirmado', compact('registro'));
    }
}