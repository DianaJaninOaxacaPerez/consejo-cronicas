@extends('admin.layout')

@section('title', 'Subir Fotografías')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="upload-container">
  <a href="{{ route('admin.galeria.index') }}" class="btn-volver-fixed">← Volver</a>

  <div class="upload-card">
    <h1>Subir Fotografías</h1>
    <p>Agrega nuevas imágenes a la galería cultural de Huejutla.</p>

    <form method="POST" action="{{ route('admin.galeria.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="input-group">
        <label>Título de la fotografía</label>
        <input type="text" name="titulo" required placeholder="Ej. Xantolo 2026" value="{{ old('titulo') }}">
      </div>

      <div class="input-group">
        <label>Descripción</label>
        <textarea name="descripcion" required placeholder="Describe la fotografía...">{{ old('descripcion') }}</textarea>
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
        <label>Seleccionar imagen</label>
        <input type="file" name="imagen" accept="image/*" required>
      </div>

      <button type="submit" class="btn-upload">Subir Fotografía</button>
    </form>
  </div>
</div>

@endsection