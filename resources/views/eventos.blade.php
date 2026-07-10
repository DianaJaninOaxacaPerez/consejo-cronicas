@extends('layouts.modulo')

@section('title', 'Eventos - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/eventos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
@endpush

@section('content')

<section class="feed-section container py-5">

  <div class="section-title text-center mb-4">
    <h2>Eventos</h2>
    <p>Novedades culturales de Huejutla</p>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
  </div>

  <div class="feed-container">
    @forelse($eventos as $evento)
      <div class="feed-card">
        <div class="feed-image">
          <img src="{{ asset('img/' . $evento->imagen) }}"
               alt="Evento"
               class="evento-foto-clic"
               data-src="{{ asset('img/' . $evento->imagen) }}"
               style="cursor: pointer;">
        </div>

        <div class="feed-info">
          <span class="tag tag-evento" style="color: #6F4A33; font-weight: bold; font-size: 15px;">
            {{ $evento->fecha->translatedFormat('d M Y') }}
          </span>
          <h3>{{ $evento->nombre }}</h3>
          <p style="margin: 0 0 8px 0;"><strong>Lugar:</strong> {{ $evento->lugar }}</p>
          <p style="color: #555; line-height: 1.6; margin: 0;">{{ $evento->descripcion }}</p>
        </div>
      </div>
    @empty
      <p style="padding: 20px; text-align: center; color: #6F4A33;">No hay eventos registrados en este momento.</p>
    @endforelse
  </div>

</section>

<div class="image-viewer" id="viewer" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; justify-content: center; align-items: center;">
  <span id="close-viewer" style="position: absolute; top: 20px; right: 30px; color: #fff; font-size: 40px; cursor: pointer; font-weight: bold;">&times;</span>
  <img id="viewer-img" src="" alt="Imagen Ampliada" style="max-width: 90%; max-height: 90%; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
</div>

@endsection

@push('scripts')
  <script src="{{ asset('js/buscador.js') }}"></script>
  <script>
    document.querySelectorAll('.evento-foto-clic').forEach(function (img) {
      img.addEventListener('click', function () {
        const viewer = document.getElementById('viewer');
        const viewerImg = document.getElementById('viewer-img');
        viewer.style.display = 'flex';
        viewerImg.src = img.dataset.src;
      });
    });

    const viewer = document.getElementById('viewer');
    const closeViewer = document.getElementById('close-viewer');

    closeViewer.addEventListener('click', function () {
      viewer.style.display = 'none';
    });

    viewer.addEventListener('click', function (e) {
      if (e.target === viewer) {
        viewer.style.display = 'none';
      }
    });
  </script>
@endpush