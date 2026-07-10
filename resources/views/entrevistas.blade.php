@extends('layouts.modulo')
@section('title', 'Entrevistas - Voces y crónicas Huejutlenses')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}?v=2">
  <link rel="stylesheet" href="{{ asset('css/entrevista.css') }}">
@endpush
@section('content')
<section class="feed-section container py-5" id="galeria">
  <div class="section-title text-center mb-4">
    <h2>Entrevistas</h2>
    <p>Conoce todo lo interesante sobre temas relevantes</p>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
  </div>

  <div class="contenido" style="width: 100%; max-width: 100%; display: block; box-sizing: border-box;">
    <div class="noticias" style="width: 100%; max-width: 100%; display: flex; flex-direction: column; align-items: center; box-sizing: border-box;">
      @forelse($entrevistas as $entrevista)
        @php
          $resumen = \Illuminate\Support\Str::limit(strip_tags($entrevista->subtitulo), 160);
        @endphp
        <article class="tarjeta-entrevista" style="display: flex; gap: 35px; margin-bottom: 40px; background: #ffffff; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(62, 22, 19, 0.05); align-items: flex-start; border: 1px solid #f1ddc4; width: 95%; max-width: 1150px; box-sizing: border-box;">
          <div style="flex-shrink: 0; width: 280px; height: 190px; overflow: hidden; border-radius: 10px;">
            <img src="{{ asset('img/entrevistas/' . $entrevista->imagen) }}" alt="Imagen" style="width: 100%; height: 100%; object-fit: cover;">
          </div>

          <div class="info" style="flex-grow: 1;">
            <h2 class="titulo-entrevista" style="margin: 0 0 12px 0; font-family: 'Playfair Display', serif; font-size: 1.8rem; line-height: 1.3;">
              <a href="{{ route('entrevistas.show', $entrevista->id) }}" style="color: #3E1613; text-decoration: none; transition: 0.3s;">
                {{ $entrevista->titulo }}
              </a>
            </h2>

            <p class="resumen-texto">
              {{ $resumen }}
            </p>

            <a href="{{ route('entrevistas.show', $entrevista->id) }}" class="btn-leer-mas">
              Leer más &rarr;
            </a>
          </div>
        </article>
      @empty
        <p style="text-align:center; color:#3E1613; width:100%;">Aún no hay entrevistas publicadas.</p>
      @endforelse
    </div>
  </div>
</section>
@endsection
@push('scripts')
  <script src="{{ asset('js/buscador.js') }}"></script>
@endpush