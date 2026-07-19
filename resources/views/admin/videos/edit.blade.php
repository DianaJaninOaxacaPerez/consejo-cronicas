@extends('admin.layout')

@section('title', 'Editar Video')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .contenedor-volver-fijo { display: block; width: 100%; margin-bottom: 20px; }
    .btn-volver-corto {
      display: inline-flex; align-items: center; justify-content: center;
      background-color: #ffffff; color: #000000; padding: 10px 24px;
      border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 14px;
      font-family: 'Poppins', sans-serif; box-shadow: 0 4px 10px rgba(0,0,0,.05);
      width: max-content; transition: background-color .2s ease;
    }
    .btn-volver-corto:hover { background-color: #f7f7f7; }
    .tipo-selector { display: flex; gap: 12px; margin-bottom: 20px; }
    .tipo-selector label {
      flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
      padding: 12px; border: 2px solid #CFE9FB; border-radius: 12px; cursor: pointer;
      font-weight: 600; transition: all .2s ease;
    }
    .tipo-selector input[type="radio"] { accent-color: #2F9BD8; }
    .tipo-selector label:has(input:checked) { background-color: #E3F1FA; border-color: #2F9BD8; }
    .campo-condicional { display: none; }
    .campo-condicional.activo { display: block; }
  </style>
@endpush

@section('content')

<div class="contenedor-volver-fijo">
  <a href="{{ route('admin.videos.index') }}" class="btn-volver-corto">← Volver</a>
</div>

<div class="upload-card">
  <h1>Editar Video</h1>
  <p>Modifica los datos del video.</p>

  <form method="POST" action="{{ route('admin.videos.update', $video) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="input-group">
      <label>Título del video</label>
      <input type="text" name="titulo" required value="{{ old('titulo', $video->titulo) }}">
    </div>

    <div class="input-group">
      <label>Descripción</label>
      <textarea name="descripcion" rows="4">{{ old('descripcion', $video->descripcion) }}</textarea>
    </div>

    <div class="input-group">
      <label>Categoría</label>
      <select name="categoria" required>
        <option value="">Selecciona una categoría</option>
        @foreach($categorias as $valor => $etiqueta)
          <option value="{{ $valor }}" {{ old('categoria', $video->categoria) === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
        @endforeach
      </select>
    </div>

    <div class="input-group">
      <label>Autor</label>
      <input type="text" name="autor" value="{{ old('autor', $video->autor) }}">
    </div>

    <div class="input-group">
      <label>¿Cómo está agregado el video?</label>
      <div class="tipo-selector">
        <label>
          <input type="radio" name="tipo" value="archivo" onchange="mostrarCampo('archivo')" {{ old('tipo', $video->tipo) === 'archivo' ? 'checked' : '' }}>
          Video subido
        </label>
        <label>
          <input type="radio" name="tipo" value="enlace" onchange="mostrarCampo('enlace')" {{ old('tipo', $video->tipo) === 'enlace' ? 'checked' : '' }}>
          Enlace externo
        </label>
      </div>
    </div>

    <div class="campo-condicional" id="campo-enlace">
      <div class="input-group">
        <label>Plataforma</label>
        <select name="plataforma">
          <option value="">Selecciona una plataforma</option>
          @foreach($plataformas as $valor => $etiqueta)
            <option value="{{ $valor }}" {{ old('plataforma', $video->plataforma) === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
          @endforeach
        </select>
      </div>
      <div class="input-group">
        <label>Enlace del video</label>
        <input type="url" name="url" value="{{ old('url', $video->url) }}">
      </div>
    </div>

    <div class="campo-condicional" id="campo-archivo">
      @if($video->archivo)
        <div class="input-group">
          <label>Video actual</label>
          <video src="{{ Storage::url($video->archivo) }}" controls style="max-width:100%; border-radius:10px;"></video>
        </div>
      @endif
      <div class="input-group">
        <label>Reemplazar archivo (opcional, máx. 250MB)</label>
        <input type="file" name="archivo" accept="video/mp4,video/quicktime,video/x-msvideo,video/webm">
      </div>
    </div>

    <button type="submit" class="btn-upload">Guardar Cambios</button>
  </form>
</div>

@endsection

@push('scripts')
<script>
function mostrarCampo(tipo) {
  document.getElementById('campo-enlace').classList.toggle('activo', tipo === 'enlace');
  document.getElementById('campo-archivo').classList.toggle('activo', tipo === 'archivo');
}
document.addEventListener('DOMContentLoaded', function () {
  const seleccionado = document.querySelector('input[name="tipo"]:checked');
  if (seleccionado) mostrarCampo(seleccionado.value);
});
</script>
@endpush