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

        $registro = RegistroEvento::where('telefono', $request->telefono)->first();

        if ($registro) {
            // Ya existe un registro con ese teléfono: solo actualizamos su mesa
            $registro->update([
                'nombre'         => $request->nombre,
                'id_mesa'        => $request->id_mesa,
                'fecha_registro' => now(),
            ]);

            return redirect()
                ->route('evento.confirmado', $registro->id_registro)
                ->with('actualizado', true);
        }

        // No existe: se crea un registro nuevo
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