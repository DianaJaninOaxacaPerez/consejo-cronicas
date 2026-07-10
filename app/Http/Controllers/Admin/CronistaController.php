<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cronista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CronistaController extends Controller
{
    public function index()
    {
        $cronistas = Cronista::orderBy('id_cronista')->get();
        return view('admin.cronistas.index', compact('cronistas'));
    }

    public function create()
    {
        return view('admin.cronistas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string',
            'paterno'   => 'nullable|string',
            'materno'   => 'nullable|string',
            'cargo'     => 'required|string',
            'biografia' => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nombre', 'paterno', 'materno', 'cargo', 'biografia', 'correo', 'telefono']);
        $data['fecha_registro'] = now();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('cronistas', 'public');
        }

        Cronista::create($data);

        return redirect()->route('admin.cronistas.index')
            ->with('success', 'Perfil creado correctamente.');
    }

    public function edit(Cronista $cronista)
    {
        return view('admin.cronistas.edit', compact('cronista'));
    }

    public function update(Request $request, Cronista $cronista)
    {
        $request->validate([
            'nombre'    => 'required|string',
            'paterno'   => 'nullable|string',
            'materno'   => 'nullable|string',
            'cargo'     => 'required|string',
            'biografia' => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nombre', 'paterno', 'materno', 'cargo', 'biografia', 'correo', 'telefono']);
        $data['fecha_actualizacion'] = now();

        if ($request->hasFile('foto')) {
            if ($cronista->foto) {
                Storage::disk('public')->delete($cronista->foto);
            }
            $data['foto'] = $request->file('foto')->store('cronistas', 'public');
        }

        $cronista->update($data);

        return redirect()->route('admin.cronistas.index')
            ->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy(Cronista $cronista)
    {
        if ($cronista->foto) {
            Storage::disk('public')->delete($cronista->foto);
        }
        $cronista->delete();

        return redirect()->route('admin.cronistas.index')
            ->with('success', 'Perfil eliminado correctamente.');
    }
}