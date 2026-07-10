<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function edit()
    {
        $config = Configuracion::find(1);
        return view('admin.configuracion.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'correo'    => 'required|email|max:150',
            'telefono'  => 'required|string|max:50',
            'ubicacion' => 'required|string|max:255',
            'facebook'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'tiktok'    => 'nullable|url|max:255',
            'youtube'   => 'nullable|url|max:255',
            'logo'      => 'nullable|image|max:2048',
        ]);

        $config = Configuracion::find(1);

        $data = $request->only(
            'correo', 'telefono', 'ubicacion',
            'facebook', 'instagram', 'tiktok', 'youtube'
        );

        if ($request->hasFile('logo')) {
            $nombreLogo = 'logo_sitio_' . time() . '.' . $request->file('logo')->extension();
            $request->file('logo')->move(public_path('img'), $nombreLogo);
            $data['logo'] = $nombreLogo;
        }

        $config->update($data);

        return redirect()->route('admin.configuracion.edit')
            ->with('success', 'Configuración actualizada correctamente.');
    }
}