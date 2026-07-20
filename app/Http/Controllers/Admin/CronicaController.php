<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cronica;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class CronicaController extends Controller
{
    // Muestra el listado de crónicas (equivale a cronicasadmin.php)
   public function index(Request $request)
{
    $query = Cronica::query();

    // Filtrar por título
    if ($request->filled('titulo')) {
        $query->where(
            'titulo',
            'like',
            '%' . $request->titulo . '%'
        );
    }

    // Filtrar por autor
    if ($request->filled('autor')) {
        $query->where(
            'autor',
            'like',
            '%' . $request->autor . '%'
        );
    }

    // Filtrar por fecha
    if ($request->filled('fecha')) {
        $query->whereDate(
            'fecha',
            $request->fecha
        );
    }

    $cronicas = $query
        ->orderBy('fecha', 'desc')
        ->paginate(10)
        ->withQueryString();

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
            'titulo'    => 'required|string|max:255',
            'autor'     => 'required|string|max:255',
            'fecha'     => 'nullable|date',
            'resumen'   => 'nullable|string|max:500',
            'contenido' => 'nullable|string',
            'imagen'    => 'nullable|image|max:20480', // 20MB de entrada, se comprime al guardar
        ]);

        $data = $request->only('titulo', 'autor', 'fecha', 'resumen', 'contenido');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = ImageUploadService::store($request->file('imagen'), 'cronicas');
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
            'titulo'    => 'required|string|max:255',
            'autor'     => 'required|string|max:255',
            'fecha'     => 'nullable|date',
            'resumen'   => 'nullable|string|max:500',
            'contenido' => 'nullable|string',
            'imagen'    => 'nullable|image|max:20480',
        ]);

        $data = $request->only('titulo', 'autor', 'fecha', 'resumen', 'contenido');

        if ($request->hasFile('imagen')) {
            ImageUploadService::delete($cronica->imagen);
            $data['imagen'] = ImageUploadService::store($request->file('imagen'), 'cronicas');
        }

        $cronica->update($data);

        return redirect()->route('admin.cronicas.index')
            ->with('success', 'Crónica actualizada correctamente.');
    }

    // Elimina una crónica (equivale a eliminar_cronica.php)
    public function destroy(Cronica $cronica)
    {
        ImageUploadService::delete($cronica->imagen);

        $cronica->delete();

        return redirect()->route('admin.cronicas.index')
            ->with('success', 'Crónica eliminada correctamente.');
    }
}