@extends('layouts.modulo')

@section('title', 'Galería - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/verfoto.css') }}">
@endpush

@section('content')

<section class="feed-section container py-5">

  <div class="section-title text-center mb-4">
    <h2>Galería Cultural</h2>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
  </div>

  <div class="gallery">
    @forelse($imagenes as $foto)
      <img
        src="{{ asset('img/' . $foto->ruta_imagen) }}"
        alt="Imagen de la galería"
        data-title="{{ $foto->titulo }}"
        data-description="{{ $foto->descripcion }}"
      >
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
  <script src="{{ asset('js/galeria.js') }}"></script>
  <script src="{{ asset('js/buscador.js') }}"></script>
@endpush