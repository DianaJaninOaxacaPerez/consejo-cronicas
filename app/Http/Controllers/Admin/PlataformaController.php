<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cronista;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class PlataformaController extends Controller
{
    public function index(Request $request)
    {
        $query = Cronista::query();

    if ($request->filled('q')) {
        $query->where(function ($sub) use ($request) {
            $sub->where('nombre', 'like', '%'.$request->q.'%')
                ->orWhere('paterno', 'like', '%'.$request->q.'%')
                ->orWhere('materno', 'like', '%'.$request->q.'%');
        });
    }

    $cronistas = $query->orderBy('nombre')->get();

    return view('admin.plataformas.index', compact('cronistas'));

    }

    public function create()
    {
        return view('admin.plataformas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:150',
            'foto'         => 'nullable|image|max:5120',
            'youtube_url'  => 'nullable|url',
            'facebook_url' => 'nullable|url',
        ]);

        $data = $request->only(['nombre', 'youtube_url', 'facebook_url']);

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageUploadService::store($request->file('foto'), 'plataformas');
        }

        Plataforma::create($data);

        return redirect()->route('admin.plataformas.index')
            ->with('success', 'Persona agregada correctamente.');
    }

    public function edit(Plataforma $plataforma)
    {
        return view('admin.plataformas.edit', compact('plataforma'));
    }

    public function update(Request $request, Plataforma $plataforma)
    {
        $request->validate([
            'nombre'       => 'required|string|max:150',
            'foto'         => 'nullable|image|max:5120',
            'youtube_url'  => 'nullable|url',
            'facebook_url' => 'nullable|url',
        ]);

        $data = $request->only(['nombre', 'youtube_url', 'facebook_url']);

        if ($request->hasFile('foto')) {
            if ($plataforma->foto) {
                ImageUploadService::delete($plataforma->foto);
            }
            $data['foto'] = ImageUploadService::store($request->file('foto'), 'plataformas');
        }

        $plataforma->update($data);

        return redirect()->route('admin.plataformas.index')
            ->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy(Plataforma $plataforma)
    {
        if ($plataforma->foto) {
            ImageUploadService::delete($plataforma->foto);
        }
        $plataforma->delete();

        return redirect()->route('admin.plataformas.index')
            ->with('success', 'Persona eliminada correctamente.');
    }
}