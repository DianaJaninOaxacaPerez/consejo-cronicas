<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cronica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CronicaController extends Controller
{
    // Muestra el listado de crónicas (equivale a cronicasadmin.php)
    public function index()
    {
        $cronicas = Cronica::orderBy('fecha', 'desc')->paginate(10);
        return view('admin.cronicas.index', compact('cronicas'));
    }

    // Muestra el formulario para crear una nueva crónica (equivale a subircronica.php)
    public function create()
    {
        return view('admin.cronicas.create');
    }

    // Procesa el formulario de creación
    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|string',
            'autor'     => 'required|string',
            'fecha'     => 'nullable|date',
            'resumen'   => 'nullable|string|max:100',
            'contenido' => 'nullable|string|max:100',
            'imagen'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only('titulo', 'autor', 'fecha', 'resumen', 'contenido');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('cronicas', 'public');
        }

        Cronica::create($data);

        return redirect()->route('admin.cronicas.index')
            ->with('success', 'Crónica creada correctamente.');
    }

    // Muestra el formulario para editar (equivale a editar_cronica.php)
    public function edit(Cronica $cronica)
    {
        return view('admin.cronicas.edit', compact('cronica'));
    }

    // Procesa la edición
    public function update(Request $request, Cronica $cronica)
    {
        $request->validate([
            'titulo'    => 'required|string',
            'autor'     => 'required|string',
            'fecha'     => 'nullable|date',
            'resumen'   => 'nullable|string|max:100',
            'contenido' => 'nullable|string|max:100',
            'imagen'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only('titulo', 'autor', 'fecha', 'resumen', 'contenido');

        if ($request->hasFile('imagen')) {
            if ($cronica->imagen) {
                Storage::disk('public')->delete($cronica->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('cronicas', 'public');
        }

        $cronica->update($data);

        return redirect()->route('admin.cronicas.index')
            ->with('success', 'Crónica actualizada correctamente.');
    }

    // Elimina una crónica (equivale a eliminar_cronica.php)
    public function destroy(Cronica $cronica)
    {
        if ($cronica->imagen) {
            Storage::disk('public')->delete($cronica->imagen);
        }

        $cronica->delete();

        return redirect()->route('admin.cronicas.index')
            ->with('success', 'Crónica eliminada correctamente.');
    }
}