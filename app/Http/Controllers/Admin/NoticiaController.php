<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use App\Models\NoticiaImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderByDesc('id_noticia')->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'categoria'   => 'required|string',
            'imagen'      => 'required|image|max:2048',
            'imagenes.*'  => 'nullable|image|max:2048',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'contenido' => $request->descripcion,
            'categoria' => $request->categoria,
            'fecha_publicacion' => now()->toDateString(),
            'id_usuario' => Auth::id(),
        ];

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia = Noticia::create($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $i => $img) {
                $ruta = $img->store('noticias', 'public');
                NoticiaImagen::create([
                    'id_noticia' => $noticia->id_noticia,
                    'imagen' => $ruta,
                    'orden' => $i,
                ]);
            }
        }

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia creada correctamente.');
    }

    public function edit(Noticia $noticia)
    {
        $noticia->load('imagenesGaleria');
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'required|string',
            'categoria'   => 'required|string',
            'imagen'      => 'nullable|image|max:2048',
            'imagenes.*'  => 'nullable|image|max:2048',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'contenido' => $request->descripcion,
            'categoria' => $request->categoria,
        ];

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen) {
                Storage::disk('public')->delete($noticia->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $i => $img) {
                $ruta = $img->store('noticias', 'public');
                NoticiaImagen::create([
                    'id_noticia' => $noticia->id_noticia,
                    'imagen' => $ruta,
                    'orden' => $i,
                ]);
            }
        }

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen) {
            Storage::disk('public')->delete($noticia->imagen);
        }

        foreach ($noticia->imagenesGaleria as $img) {
            Storage::disk('public')->delete($img->imagen);
            $img->delete();
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia eliminada correctamente.');
    }

    public function destroyImagen(NoticiaImagen $imagene)
    {
        Storage::disk('public')->delete($imagene->imagen);
        $idNoticia = $imagene->id_noticia;
        $imagene->delete();

        return redirect()->route('admin.noticias.edit', $idNoticia)
            ->with('success', 'Imagen eliminada de la galería.');
    }
}