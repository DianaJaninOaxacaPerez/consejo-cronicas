<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Historia::query();

        // Búsqueda por título
        if ($request->filled('q')) {
            $query->where('titulo', 'like', '%'.$request->q.'%');
        }

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtro por autor
        if ($request->filled('autor')) {
            $query->where('autor', 'like', '%'.$request->autor.'%');
        }

        // Filtro por rango de fechas
        if ($request->filled('desde')) {
            $query->whereDate('fecha_creacion', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_creacion', '<=', $request->hasta);
        }

        // Orden (reciente por defecto)
        $orden = $request->get('orden', 'reciente');
        $query->orderBy('fecha_creacion', $orden === 'antigua' ? 'asc' : 'desc');

        $historias = $query->paginate(9)->withQueryString();

        return view('admin.historias.index', [
            'historias'  => $historias,
            'categorias' => Historia::CATEGORIAS,
        ]);
    }

    public function create()
    {
        return view('admin.historias.create', [
            'categorias' => Historia::CATEGORIAS,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'fecha'       => 'required|date',
            'imagen'      => 'required|image|max:2048',
            'categoria'   => 'required|in:'.implode(',', array_keys(Historia::CATEGORIAS)),
            'autor'       => 'nullable|string|max:100',
        ]);

        $data = [
            'titulo'               => $request->titulo,
            'descripcion'          => $request->descripcion,
            'categoria'            => $request->categoria,
            'autor'                => $request->autor,
            'fecha_creacion'       => $request->fecha,
            'fecha_actualizacion'  => now(),
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
        return view('admin.historias.edit', [
            'historia'   => $historia,
            'categorias' => Historia::CATEGORIAS,
        ]);
    }

    public function update(Request $request, Historia $historia)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'imagen'      => 'nullable|image|max:2048',
            'categoria'   => 'required|in:'.implode(',', array_keys(Historia::CATEGORIAS)),
            'autor'       => 'nullable|string|max:100',
        ]);

        $data = [
            'titulo'              => $request->titulo,
            'descripcion'         => $request->descripcion,
            'categoria'           => $request->categoria,
            'autor'               => $request->autor,
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