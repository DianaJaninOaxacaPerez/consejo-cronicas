<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoriaController extends Controller
{
    public function index()
    {
        $historias = Historia::orderBy('fecha_creacion', 'desc')->paginate(10);
        return view('admin.historias.index', compact('historias'));
    }

    public function create()
    {
        return view('admin.historias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'fecha'       => 'required|date',
            'imagen'      => 'required|image|max:2048',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_creacion' => $request->fecha,
            'fecha_actualizacion' => now(),
        ];

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('historias', 'public');
        }

        Historia::create($data);

        return redirect()->route('admin.historias.index')
            ->with('success', 'Historia creada correctamente.');
    }

    public function edit(Historia $historia)
    {
        return view('admin.historias.edit', compact('historia'));
    }

    public function update(Request $request, Historia $historia)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'imagen'      => 'nullable|image|max:2048',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_actualizacion' => now(),
        ];

        if ($request->hasFile('imagen')) {
            if ($historia->imagen) {
                Storage::disk('public')->delete($historia->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('historias', 'public');
        }

        $historia->update($data);

        return redirect()->route('admin.historias.index')
            ->with('success', 'Historia actualizada correctamente.');
    }

    public function destroy(Historia $historia)
    {
        if ($historia->imagen) {
            Storage::disk('public')->delete($historia->imagen);
        }

        $historia->delete();

        return redirect()->route('admin.historias.index')
            ->with('success', 'Historia eliminada correctamente.');
    }
}