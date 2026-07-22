<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistroEvento;
use App\Models\Mesa;

class RegistroEventoController extends Controller
{
    public function index()
    {
        $registros = RegistroEvento::with('mesa')->orderByDesc('fecha_registro')->get();
        $mesas = Mesa::orderBy('id_mesa')->get();
        $urlPublica = route('evento.confirmar.form');

        return view('admin.registros-evento.index', compact('registros', 'mesas', 'urlPublica'));
    }

    public function destroy(RegistroEvento $registro)
    {
        $registro->delete();
        return redirect()->route('admin.registros-evento.index')
            ->with('success', 'Registro eliminado.');
    }

    public function conteo()
    {
    return response()->json(['total' => RegistroEvento::count()]);
    }
}