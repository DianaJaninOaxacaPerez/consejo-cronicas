@extends('admin.layout')
@section('title', 'Agregar Noticia')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
@endpush
@section('content')
<div class="section-title text-center mb-4">
  <h2>Agregar Noticia</h2>
  <p>Completa los datos para publicar una nueva noticia</p>
</div>

<div class="feed-container" style="max-width: 700px; margin: 0 auto;">
  <div class="feed-card" style="flex-direction: column; padding: 24px;">

    @if ($errors->any())
      <div class="alert alert-danger" style="background:#f8d7da; color:#842029; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
        <ul style="margin:0; padding-left:20px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="titulo" class="form-label"><strong>Título</strong></label>
        <input type="text" name="titulo" id="titulo" class="form-control"
               value="{{ old('titulo') }}" required>
      </div>

      <div class="mb-3">
        <label for="categoria" class="form-label"><strong>Categoría</strong></label>
        <input type="text" name="categoria" id="categoria" class="form-control"
               value="{{ old('categoria') }}" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label"><strong>Descripción</strong></label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="6" required>{{ old('descripcion') }}</textarea>
      </div>

      <div class="mb-3">
        <label for="imagen" class="form-label"><strong>Imagen principal</strong></label>
        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
      </div>

      <div class="mb-3">
        <label for="imagenes" class="form-label"><strong>Galería de imágenes (opcional)</strong></label>
        <input type="file" name="imagenes[]" id="imagenes" class="form-control" accept="image/*" multiple>
      </div>

      <div class="feed-actions" style="margin-top:20px;">
        <button type="submit" class="btn-admin" style="border:none; cursor:pointer;">Publicar Noticia</button>
        <a href="{{ route('admin.noticias.index') }}" class="btn-editar">Cancelar</a>
      </div>

    </form>
  </div>
</div>
@endsection
@push('scripts')
@endpush