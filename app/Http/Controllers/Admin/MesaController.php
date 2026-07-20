<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::orderBy('id_mesa')->get();
        return view('admin.mesas.index', compact('mesas'));
    }

    public function update(Request $request, Mesa $mesa)
    {
        $request->validate(['nombre' => 'required|string|max:150']);
        $mesa->update(['nombre' => $request->nombre]);

        return redirect()->route('admin.mesas.index')
            ->with('success', 'Mesa actualizada correctamente.');
    }
}