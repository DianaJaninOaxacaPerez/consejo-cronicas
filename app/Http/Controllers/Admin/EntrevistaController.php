<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrevista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrevistaController extends Controller
{
    public function index()
    {
        $entrevistas = Entrevista::orderByDesc('id')->get();
        return view('admin.entrevistas.index', compact('entrevistas'));
    }

    public function create()
    {
        return view('admin.entrevistas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'subtitulo' => 'required|string|max:200',
            'contenido' => 'required|string',
            'imagen'    => 'required|image|max:5120',
        ]);

        $data = $request->only('titulo', 'subtitulo', 'contenido');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('entrevistas', 'public');
        }

        Entrevista::create($data);

        return redirect()->route('admin.entrevistas.index')
            ->with('success', 'Entrevista creada correctamente.');
    }

    public function edit(Entrevista $entrevista)
    {
        return view('admin.entrevistas.edit', compact('entrevista'));
    }

    public function update(Request $request, Entrevista $entrevista)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'subtitulo' => 'required|string|max:200',
            'contenido' => 'required|string',
            'imagen'    => 'nullable|image|max:5120',
        ]);

        $data = $request->only('titulo', 'subtitulo', 'contenido');

        if ($request->hasFile('imagen')) {
            if ($entrevista->imagen) {
                Storage::disk('public')->delete($entrevista->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('entrevistas', 'public');
        }

        $entrevista->update($data);

        return redirect()->route('admin.entrevistas.index')
            ->with('success', 'Entrevista actualizada correctamente.');
    }

    public function destroy(Entrevista $entrevista)
    {
        if ($entrevista->imagen) {
            Storage::disk('public')->delete($entrevista->imagen);
        }

        $entrevista->delete();

        return redirect()->route('admin.entrevistas.index')
            ->with('success', 'Entrevista eliminada correctamente.');
    }
}