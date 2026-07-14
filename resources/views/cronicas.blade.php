@extends('layouts.modulo')

@section('title', 'Crónicas - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">

  <style>
    .cronica-card img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      border-radius: 12px 12px 0 0;
      display: block;
    }

    .btn-pill.btn-leer-cronica {
      display: inline-block;
      padding: 0.55rem 1.6rem;
      border-radius: 999px;
      border: none;
      background: #1565C0;
      color: #fff;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: background-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
      box-shadow: 0 3px 10px rgba(21, 101, 192, 0.25);
    }

    .btn-pill.btn-leer-cronica:hover {
      background: #0d47a1;
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(21, 101, 192, 0.35);
    }

    .btn-pill.btn-leer-cronica:active {
      transform: translateY(0);
    }
  </style>
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
      @php $imgDefault = asset('img/default-cronica.png'); @endphp
      <div class="card cronica-card">
        <img src="{{ $cronica->imagen ? Storage::url($cronica->imagen) : $imgDefault }}"
             alt="{{ $cronica->titulo }}"
             onerror="this.onerror=null;this.src='{{ $imgDefault }}';">

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
  <script src="{{ asset('js/leercronica.js') }}?v={{ filemtime(public_path('js/leercronica.js')) }}"></script>
  <script src="{{ asset('js/buscador.js') }}?v={{ filemtime(public_path('js/buscador.js')) }}"></script>
@endpush