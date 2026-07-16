@extends('admin.layout')
@section('title', 'Editar Noticia')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
@endpush
@section('content')
<div class="section-title text-center mb-4">
  <h2>Editar Noticia</h2>
  <p>Actualiza los datos de la noticia</p>
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

    <form action="{{ route('admin.noticias.update', $noticia) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="titulo" class="form-label"><strong>Título</strong></label>
        <input type="text" name="titulo" id="titulo" class="form-control"
               value="{{ old('titulo', $noticia->titulo) }}" required>
      </div>

      <div class="mb-3">
        <label for="categoria" class="form-label"><strong>Categoría</strong></label>
        <input type="text" name="categoria" id="categoria" class="form-control"
               value="{{ old('categoria', $noticia->categoria) }}" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label"><strong>Descripción</strong></label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="6" required>{{ old('descripcion', $noticia->descripcion) }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Imagen principal actual</strong></label><br>
        @if ($noticia->imagen)
          <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen actual" style="max-width:200px; border-radius:8px; margin-bottom:10px; display:block;">
        @else
          <p>No hay imagen principal cargada.</p>
        @endif
        <label for="imagen" class="form-label">Reemplazar imagen (opcional)</label>
        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
      </div>

      @if ($noticia->imagenesGaleria && $noticia->imagenesGaleria->count())
        <div class="mb-3">
          <label class="form-label"><strong>Galería actual</strong></label>
          <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:10px;">
            @foreach ($noticia->imagenesGaleria as $img)
              <div style="position:relative;">
                <img src="{{ asset('storage/' . $img->imagen) }}" alt="Imagen galería" style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
                <label style="display:block; font-size:12px; text-align:center;">
                  <input type="checkbox" name="eliminar_imagenes[]" value="{{ $img->id }}"> Eliminar
                </label>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <div class="mb-3">
        <label for="imagenes" class="form-label"><strong>Agregar imágenes a la galería (opcional)</strong></label>
        <input type="file" name="imagenes[]" id="imagenes" class="form-control" accept="image/*" multiple>
      </div>

      <div class="feed-actions" style="margin-top:20px;">
        <button type="submit" class="btn-admin" style="border:none; cursor:pointer;">Guardar Cambios</button>
        <a href="{{ route('admin.noticias.index') }}" class="btn-editar">Cancelar</a>
      </div>

    </form>
  </div>
</div>
@endsection
@push('scripts')
@endpush