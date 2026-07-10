@extends('admin.layout')
@section('title', 'Configuración del Sitio')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <style>
    .form-container { max-width: 600px; margin: 0 auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: bold; margin-bottom: 8px; color: #333; }
    .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="url"] { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    .btn-guardar { background: #4A154B; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; }
    .btn-guardar:hover { background: #3a103b; }
    .form-subtitulo { margin: 30px 0 15px; padding-top: 20px; border-top: 1px solid #eee; color: #555; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; }
  </style>
@endpush
@section('content')
<div class="form-container">
    <form action="{{ route('admin.configuracion.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Logo Actual del Sitio:</label>
            <img src="{{ asset('img/' . $config->logo) }}" alt="Logo Actual" style="max-height: 80px; display:block; margin-bottom: 15px; border: 1px solid #ddd; padding: 5px;">
            <input type="file" name="logo" accept="image/*">
        </div>
        <div class="form-group">
            <label>Correo Electrónico de Contacto:</label>
            <input type="email" name="correo" value="{{ old('correo', $config->correo) }}" required>
        </div>
        <div class="form-group">
            <label>Teléfono de Contacto:</label>
            <input type="text" name="telefono" value="{{ old('telefono', $config->telefono) }}" required>
        </div>
        <div class="form-group">
            <label>Ubicación / Dirección:</label>
            <input type="text" name="ubicacion" value="{{ old('ubicacion', $config->ubicacion) }}" required>
        </div>

        <div class="form-subtitulo">Redes sociales</div>

        <div class="form-group">
            <label>Facebook (URL completa):</label>
            <input type="url" name="facebook" placeholder="https://www.facebook.com/tu-pagina" value="{{ old('facebook', $config->facebook) }}">
        </div>
        <div class="form-group">
            <label>Instagram (URL completa):</label>
            <input type="url" name="instagram" placeholder="https://www.instagram.com/tu-usuario" value="{{ old('instagram', $config->instagram) }}">
        </div>
        <div class="form-group">
            <label>TikTok (URL completa):</label>
            <input type="url" name="tiktok" placeholder="https://www.tiktok.com/@tu-usuario" value="{{ old('tiktok', $config->tiktok) }}">
        </div>
        <div class="form-group">
            <label>YouTube (URL completa):</label>
            <input type="url" name="youtube" placeholder="https://www.youtube.com/@tu-canal" value="{{ old('youtube', $config->youtube) }}">
        </div>

        <button type="submit" class="btn-guardar">Guardar Configuración</button>
    </form>
</div>
@endsection