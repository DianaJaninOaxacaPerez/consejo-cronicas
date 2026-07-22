<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\RegistroEvento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    private function dentroDeHorario()
    {
        $ahora = now();

        $inicio = Carbon::create($ahora->year, 8, 15, 8, 0, 0);
        $fin    = Carbon::create($ahora->year, 8, 15, 8, 50, 0);

        return $ahora->between($inicio, $fin);
    }

    public function form()
    {
        $mesas   = Mesa::orderBy('id_mesa')->get();
        $abierto = $this->dentroDeHorario();

        return view('evento-confirmar', compact('mesas', 'abierto'));
    }

    public function store(Request $request)
    {
        if (!$this->dentroDeHorario()) {
            return redirect()->route('evento.confirmar.form')
                ->with('error', 'El registro solo está disponible el 15 de agosto de 8:00 a.m. a 8:50 a.m.');
        }

        $request->validate([
            'nombre'   => 'required|string|max:150',
            'telefono' => 'required|string|max:20',
            'id_mesa'  => 'required|exists:mesas_trabajo,id_mesa',
        ]);

        $registro = RegistroEvento::where('telefono', $request->telefono)->first();

        if ($registro) {
            $registro->update([
                'nombre'         => $request->nombre,
                'id_mesa'        => $request->id_mesa,
                'fecha_registro' => now(),
            ]);

            return redirect()
                ->route('evento.confirmado', $registro->id_registro)
                ->with('actualizado', true);
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