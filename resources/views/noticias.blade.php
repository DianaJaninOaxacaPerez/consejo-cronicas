@extends('layouts.modulo')

@section('title', 'Noticias - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}?v=2">
@endpush

@section('content')

<section class="feed-section container py-5">

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
          ? asset('img/noticias/' . $noticia->imagen)
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
          <span class="tag tag-evento">{{ $noticia->categoria ?? 'General' }}</span>
          <h3>{{ $noticia->titulo }}</h3>
          <p class="fecha-noticia">
            @if($noticia->fecha_publicacion)
              {{ $noticia->fecha_publicacion->format('d/m/Y') }}
            @else
              Sin fecha
            @endif
          </p>
          <p>{{ $resumen }}</p>
          <a href="{{ route('noticias.show', $noticia->id_noticia) }}" class="btn-leer-mas">Leer más →</a>
        </div>
      </div>
    @empty
      <p style="padding:20px;">Aún no hay noticias publicadas.</p>
    @endforelse
  </div>

</section>

@endsection

@push('scripts')
  <script src="{{ asset('js/buscador.js') }}"></script>
@endpush