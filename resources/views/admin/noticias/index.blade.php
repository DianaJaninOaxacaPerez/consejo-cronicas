@extends('admin.layout')

@section('title', 'Noticias')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
@endpush

@section('content')

<div class="section-title text-center mb-4">
  <h2>Noticias</h2>
  <p>Entérate de las últimas novedades</p>
</div>

<div class="search-box mb-4 mx-auto" style="max-width: 400px;">
  <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
</div>

<div class="feed-container">
  @forelse($noticias as $noticia)
    @php
      $rutaImagen = $noticia->imagen
        ? Storage::url($noticia->imagen)
        : 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=600';

      $resumen = mb_strlen($noticia->contenido) > 160
        ? mb_substr($noticia->contenido, 0, 160) . '...'
        : $noticia->contenido;
    @endphp

    <div class="feed-card">
      <div class="feed-image">
        <img src="{{ $rutaImagen }}" alt="{{ $noticia->titulo }}">
      </div>
      <div class="feed-info">
        <span class="tag tag-evento">{{ $noticia->categoria ?? 'Noticia' }}</span>
        <h3>{{ $noticia->titulo }}</h3>
        <p>{{ $resumen }}</p>

        <div class="feed-actions">
          <a href="{{ route('admin.noticias.edit', $noticia) }}" class="btn-editar">Editar</a>
          <form action="{{ route('admin.noticias.destroy', $noticia) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres borrar esta noticia? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-borrar" style="border:none;cursor:pointer;">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding:20px;">Aún no hay noticias publicadas.</p>
  @endforelse

  <div class="card admin-card">
    <div class="card-content">
      <h3>Agregar Contenido</h3>
      <p>Administre las noticias.</p>
      <a href="{{ route('admin.noticias.create') }}" class="btn-admin">Agregar</a>
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="{{ asset('js/buscador.js') }}"></script>
@endpush