@extends('admin.layout')

@section('title', 'Editar Fotografía')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .contenedor-volver-fijo {
        display: block;
        width: 100%;
        margin-bottom: 20px;
    }
    .btn-volver-corto {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        color: #000000;
        padding: 10px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        width: max-content;
        transition: background-color 0.2s ease;
    }
    .btn-volver-corto:hover {
        background-color: #f7f7f7;
    }
  </style>
@endpush

@section('content')

<div class="contenedor-volver-fijo">
  <a href="{{ route('admin.galeria.index') }}" class="btn-volver-corto">← Volver</a>
</div>

<div class="upload-card">
  <h1>Editar Fotografía</h1>
  <p>Modifica el título, descripción o la imagen de la galería cultural.</p>

  <form method="POST" action="{{ route('admin.galeria.update', $foto) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="input-group">
      <label>Título de la Imagen</label>
      <input type="text" name="titulo" required value="{{ old('titulo', $foto->titulo) }}">
    </div>

    <div class="input-group">
      <label>Descripción / Contexto Histórico</label>
      <textarea name="descripcion" required rows="5">{{ old('descripcion', $foto->descripcion) }}</textarea>
    </div>

    <div class="input-group">
      <label>Categoría</label>
      <select name="categoria" required>
        <option value="">Selecciona una categoría</option>
        @foreach($categorias as $valor => $etiqueta)
          <option value="{{ $valor }}" {{ old('categoria', $foto->categoria) === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
        @endforeach
      </select>
    </div>

    @if($foto->ruta_imagen)
    <div class="input-group">
      <label>Imagen actual</label>
      <img src="{{ Storage::url($foto->ruta_imagen) }}" style="max-width:220px; border-radius:10px; display:block; margin-top:8px;">
    </div>
    @endif

    <div class="input-group">
      <label>Reemplazar Imagen (opcional)</label>
      <input type="file" name="ruta_imagen" accept="image/*">
    </div>

    <button type="submit" class="btn-upload">Guardar Cambios</button>
  </form>
</div>

@endsection