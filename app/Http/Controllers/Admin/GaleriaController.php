<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
class GaleriaController extends Controller
{
    public function index()
    {
        $imagenes = Galeria::orderByDesc('id_galeria')->get();
        return view('admin.galeria.index', compact('imagenes'));
    }
    public function create()
    {
        return view('admin.galeria.create', [
            'categorias' => Galeria::CATEGORIAS,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'categoria'   => 'required|in:'.implode(',', array_keys(Galeria::CATEGORIAS)),
            'imagen'      => 'required|image|max:20480',
        ]);
        $data = [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
        ];
        if ($request->hasFile('imagen')) {
            $data['ruta_imagen'] = ImageUploadService::store($request->file('imagen'), 'galeria');
        }
        Galeria::create($data);
        return redirect()->route('admin.galeria.index')
            ->with('success', 'Fotografía subida con éxito.');
    }
    public function edit(Galeria $galerium)
    {
        return view('admin.galeria.edit', [
            'foto' => $galerium,
            'categorias' => Galeria::CATEGORIAS,
        ]);
    }
    public function update(Request $request, Galeria $galerium)
    {
        $request->validate([
            'titulo'       => 'required|string',
            'descripcion'  => 'required|string',
            'categoria'    => 'required|in:'.implode(',', array_keys(Galeria::CATEGORIAS)),
            'ruta_imagen'  => 'nullable|image|max:20480',
        ]);
        $data = [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
        ];
        if ($request->hasFile('ruta_imagen')) {
            ImageUploadService::delete($galerium->ruta_imagen);
            $data['ruta_imagen'] = ImageUploadService::store($request->file('ruta_imagen'), 'galeria');
        }
        $galerium->update($data);
        return redirect()->route('admin.galeria.index')
            ->with('success', 'Fotografía actualizada correctamente.');
    }
    public function destroy(Galeria $galerium)
    {
        ImageUploadService::delete($galerium->ruta_imagen);
        $galerium->delete();
        return redirect()->route('admin.galeria.index')
            ->with('success', 'Imagen eliminada correctamente.');
    }
}