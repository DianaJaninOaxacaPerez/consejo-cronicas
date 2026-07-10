@extends('layouts.modulo')

@section('title', 'Crónicas - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<section id="cronicas" class="container py-5">

  <div class="section-title text-center mb-4">
    <h2>Crónicas y Relatos</h2>
    <p>Historias que mantienen viva la memoria</p>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
  </div>

  <div class="cards-cronicas">
    @forelse($cronicas as $cronica)
      <div class="card cronica-card">
        <img src="{{ asset('img/' . $cronica->imagen) }}" alt="{{ $cronica->titulo }}">

        <div class="card-content">
          <span class="cronica-fecha">{{ $cronica->fecha->translatedFormat('d M Y') }}</span>

          <h3>{{ $cronica->titulo }}</h3>
          <h4>Por: {{ $cronica->autor }}</h4>

          <p class="cronica-resumen">{{ $cronica->resumen }}</p>

          <div class="acciones-cronica">
            <button class="btn-pill btn-leer-cronica"
              onclick="mostrarCronica(this)"
              data-titulo="{{ $cronica->titulo }}"
              data-autor="{{ $cronica->autor }}"
              data-fecha="{{ $cronica->fecha->translatedFormat('d M Y') }}"
              data-contenido="{{ $cronica->contenido }}">
              Leer Crónica
            </button>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center">Próximamente más crónicas de nuestra región.</p>
    @endforelse
  </div>

</section>

@endsection

@push('scripts')
  <script src="{{ asset('js/leercronica.js') }}"></script>
  <script src="{{ asset('js/buscador.js') }}"></script>
@endpush