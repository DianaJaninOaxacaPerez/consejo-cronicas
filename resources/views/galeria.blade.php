@extends('layouts.modulo')

@section('title', 'Galería - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/verfoto.css') }}">

  <style>
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 1.25rem;
      margin-top: 1.5rem;
    }

    .gallery img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery img:hover {
      transform: translateY(-4px) scale(1.02);
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
    }
  </style>
@endpush

@section('content')

<section class="feed-section container py-5">

  <div class="section-title text-center mb-4">
    <h2>Galería Cultural</h2>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
  </div>

  @forelse($imagenes as $foto)
  @php $imgDefault = asset('img/default-galeria.png'); @endphp

  <div
    class="gallery-item-container"
    data-title="{{ $foto->titulo }}"
    data-description="{{ $foto->descripcion }}"
  >
    <img
      src="{{ $foto->ruta_imagen ? Storage::url($foto->ruta_imagen) : $imgDefault }}"
      alt="{{ $foto->titulo }}"
      data-title="{{ $foto->titulo }}"
      data-description="{{ $foto->descripcion }}"
      onerror="this.onerror=null;this.src='{{ $imgDefault }}';"
    >
  </div>
@empty
      <p class="text-center">Próximamente más imágenes en la galería.</p>
    @endforelse
  </div>

</section>

<div class="image-viewer" id="viewer">
  <span id="close-viewer">&times;</span>
  <div class="viewer-content">
    <img id="viewer-img" src="" alt="Visor grande">
    <h2 id="viewer-title"></h2>
    <p id="viewer-description"></p>
  </div>
</div>

@endsection

@push('scripts')
  <script src="{{ asset('js/galeria.js') }}?v={{ filemtime(public_path('js/galeria.js')) }}"></script>
  <script src="{{ asset('js/buscador.js') }}?v={{ filemtime(public_path('js/buscador.js')) }}"></script>
@endpush