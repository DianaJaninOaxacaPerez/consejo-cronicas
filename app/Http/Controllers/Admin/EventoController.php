<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::orderByDesc('id_evento')->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('admin.eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string',
            'fecha'       => 'required|date',
            'lugar'       => 'required|string',
            'descripcion' => 'required|string',
            'imagen'      => 'required|image|max:2048',
        ]);

        $data = $request->only('nombre', 'fecha', 'lugar', 'descripcion');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        Evento::create($data);

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento creado correctamente.');
    }

    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nombre'      => 'required|string',
            'fecha'       => 'required|date',
            'lugar'       => 'required|string',
            'descripcion' => 'required|string',
            'imagen'      => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nombre', 'fecha', 'lugar', 'descripcion');

        if ($request->hasFile('imagen')) {
            if ($evento->imagen) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->update($data);

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        if ($evento->imagen) {
            Storage::disk('public')->delete($evento->imagen);
        }

        $evento->delete();

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}