@extends('admin.layout')

@section('title', 'Subir Video')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    .tipo-selector {
      display: flex;
      gap: 12px;
      margin-bottom: 20px;
    }
    .tipo-selector label {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px;
      border: 2px solid #CFE9FB;
      border-radius: 12px;
      cursor: pointer;
      font-weight: 600;
      transition: all .2s ease;
    }
    .tipo-selector input[type="radio"] {
      accent-color: #2F9BD8;
    }
    .tipo-selector label:has(input:checked) {
      background-color: #E3F1FA;
      border-color: #2F9BD8;
    }
    .campo-condicional {
      display: none;
    }
    .campo-condicional.activo {
      display: block;
    }
  </style>
@endpush

@section('content')

<div class="upload-container">
  <a href="{{ route('admin.videos.index') }}" class="btn-volver-fixed">← Volver</a>

  <div class="upload-card">
    <h1>Subir Video</h1>
    <p>Agrega un video grabado o un enlace de una red social.</p>

    <form method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="input-group">
        <label>Título del video</label>
        <input type="text" name="titulo" required placeholder="Ej. Danza de los Voladores" value="{{ old('titulo') }}">
      </div>

      <div class="input-group">
        <label>Descripción</label>
        <textarea name="descripcion" placeholder="Describe el video...">{{ old('descripcion') }}</textarea>
      </div>

      <div class="input-group">
        <label>Categoría</label>
        <select name="categoria" required>
          <option value="">Selecciona una categoría</option>
          @foreach($categorias as $valor => $etiqueta)
            <option value="{{ $valor }}" {{ old('categoria') === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
          @endforeach
        </select>
      </div>

      <div class="input-group">
        <label>Autor</label>
        <input type="text" name="autor" placeholder="Ej. Consejo Huejutlense" value="{{ old('autor') }}">
      </div>

      <div class="input-group">
        <label>¿Cómo quieres agregar el video?</label>
        <div class="tipo-selector">
          <label>
            <input type="radio" name="tipo" value="archivo" onchange="mostrarCampo('archivo')" {{ old('tipo', 'enlace') === 'archivo' ? 'checked' : '' }}>
            Subir video grabado
          </label>
          <label>
            <input type="radio" name="tipo" value="enlace" onchange="mostrarCampo('enlace')" {{ old('tipo', 'enlace') === 'enlace' ? 'checked' : '' }}>
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
              <option value="{{ $valor }}" {{ old('plataforma') === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group">
          <label>Enlace del video</label>
          <input type="url" name="url" placeholder="https://..." value="{{ old('url') }}">
        </div>
      </div>

      <div class="campo-condicional" id="campo-archivo">
        <div class="input-group">
          <label>Seleccionar archivo de video (máx. 250MB)</label>
          <input type="file" name="archivo" accept="video/mp4,video/quicktime,video/x-msvideo,video/webm">
        </div>
      </div>

      <button type="submit" class="btn-upload">Guardar Video</button>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
function mostrarCampo(tipo) {
  document.getElementById('campo-enlace').classList.toggle('activo', tipo === 'enlace');
  document.getElementById('campo-archivo').classList.toggle('activo', tipo === 'archivo');
}
// Ejecutar al cargar la página según lo seleccionado
document.addEventListener('DOMContentLoaded', function () {
  const seleccionado = document.querySelector('input[name="tipo"]:checked');
  if (seleccionado) mostrarCampo(seleccionado.value);
});
</script>
@endpush