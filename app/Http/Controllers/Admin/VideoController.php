<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Services\VideoUploadService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderByDesc('id_video')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create', [
            'categorias'  => Video::CATEGORIAS,
            'plataformas' => Video::PLATAFORMAS,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'categoria'   => 'required|in:'.implode(',', array_keys(Video::CATEGORIAS)),
            'tipo'        => 'required|in:archivo,enlace',
            'autor'       => 'nullable|string|max:100',

            // Requeridos condicionalmente según el tipo
            'plataforma'  => 'required_if:tipo,enlace|nullable|in:'.implode(',', array_keys(Video::PLATAFORMAS)),
            'url'         => 'required_if:tipo,enlace|nullable|url',
            'archivo'     => 'required_if:tipo,archivo|nullable|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/webm|max:256000',
        ]);

        $data = $request->only(['titulo', 'descripcion', 'categoria', 'tipo', 'autor']);

        if ($request->tipo === 'enlace') {
            $data['plataforma'] = $request->plataforma;
            $data['url'] = $request->url;
        } else {
            $data['archivo'] = VideoUploadService::store($request->file('archivo'), 'videos');
        }

        Video::create($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video agregado correctamente.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', [
            'video'       => $video,
            'categorias'  => Video::CATEGORIAS,
            'plataformas' => Video::PLATAFORMAS,
        ]);
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'titulo'      => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'categoria'   => 'required|in:'.implode(',', array_keys(Video::CATEGORIAS)),
            'tipo'        => 'required|in:archivo,enlace',
            'autor'       => 'nullable|string|max:100',

            'plataforma'  => 'required_if:tipo,enlace|nullable|in:'.implode(',', array_keys(Video::PLATAFORMAS)),
            'url'         => 'required_if:tipo,enlace|nullable|url',
            'archivo'     => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/webm|max:256000',
        ]);

        $data = $request->only(['titulo', 'descripcion', 'categoria', 'tipo', 'autor']);

        if ($request->tipo === 'enlace') {
            $data['plataforma'] = $request->plataforma;
            $data['url'] = $request->url;
            // Si antes tenía un archivo subido y ahora cambia a enlace, lo borramos
            if ($video->archivo) {
                VideoUploadService::delete($video->archivo);
                $data['archivo'] = null;
            }
        } else {
            $data['plataforma'] = null;
            $data['url'] = null;
            if ($request->hasFile('archivo')) {
                VideoUploadService::delete($video->archivo);
                $data['archivo'] = VideoUploadService::store($request->file('archivo'), 'videos');
            }
        }

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video actualizado correctamente.');
    }

    public function destroy(Video $video)
    {
        if ($video->archivo) {
            VideoUploadService::delete($video->archivo);
        }
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video eliminado correctamente.');
    }
}