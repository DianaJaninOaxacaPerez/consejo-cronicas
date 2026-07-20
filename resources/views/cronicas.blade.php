@extends('layouts.modulo')

@section('title', 'Crónicas - Voces y crónicas Huejutlenses')

@push('styles')
  <link
    rel="stylesheet"
    href="{{ asset('css/catalogo.css') }}?v={{ filemtime(public_path('css/catalogo.css')) }}"
  >

  <style>
    .btn-pill.btn-leer-cronica {
      display: inline-block;
      padding: 0.55rem 1.6rem;
      border: none;
      border-radius: 999px;
      background: #1565c0;
      color: #ffffff;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 3px 10px rgba(21, 101, 192, 0.25);
      transition:
        background-color 0.25s ease,
        transform 0.25s ease,
        box-shadow 0.25s ease;
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

  <form
  method="GET"
  action="{{ route('cronicas') }}"
  class="filtros-cronicas"
>
  <span class="filtros-cronicas__label">
    Filtros
  </span>

  <input
    type="text"
    name="titulo"
    class="filtros-cronicas__input"
    placeholder="Título de la crónica"
    value="{{ request('titulo') }}"
  >

  <input
    type="text"
    name="autor"
    class="filtros-cronicas__input"
    placeholder="Autor"
    value="{{ request('autor') }}"
  >

  <input
    type="date"
    name="fecha"
    class="filtros-cronicas__input"
    value="{{ request('fecha') }}"
  >

  <button
    type="submit"
    class="filtros-cronicas__btn"
    title="Aplicar filtros"
  >
    +
  </button>

  @if(request()->anyFilled(['titulo', 'autor', 'fecha']))
    <a
      href="{{ route('cronicas') }}"
      class="filtros-cronicas__limpiar"
    >
      Limpiar filtros
    </a>
  @endif
</form>

  <div class="cronicas-grid">

    @forelse($cronicas as $cronica)

      @php
        $imgDefault = asset('img/default-cronica.png');
      @endphp

      <article class="cronica-card">

        <div class="cronica-card__imagen-contenedor">
          <img
            src="{{ $cronica->imagen
                ? Storage::url($cronica->imagen)
                : $imgDefault }}"
            alt="{{ $cronica->titulo }}"
            class="cronica-card__imagen"
            onerror="this.onerror=null;this.src='{{ $imgDefault }}';"
          >
        </div>

        <div class="cronica-card__contenido">

          <span class="cronica-etiqueta">
            Crónica
          </span>

          <h3>
            {{ $cronica->titulo }}
          </h3>

          <h4>
            Por: {{ $cronica->autor }}
          </h4>

          <p class="cronica-resumen">
            {{ $cronica->resumen }}
          </p>

          <small class="cronica-card__fecha">
            {{ $cronica->fecha
                ? $cronica->fecha->translatedFormat('d M Y')
                : 'Sin fecha' }}
          </small>

          <div class="acciones-cronica">

            <button
              type="button"
              class="btn-pill btn-leer-cronica"
              onclick="mostrarCronica(this)"
              data-titulo="{{ $cronica->titulo }}"
              data-autor="{{ $cronica->autor }}"
              data-fecha="{{ $cronica->fecha
                  ? $cronica->fecha->translatedFormat('d M Y')
                  : '' }}"
              data-contenido="{{ $cronica->contenido }}"
            >
              Leer Crónica
            </button>

          </div>

        </div>

      </article>

    @empty

      <p class="cronicas-vacio">
        Próximamente más crónicas de nuestra región.
      </p>

    @endforelse

  </div>

</section>

@endsection

@push('scripts')
  <script
    src="{{ asset('js/leercronica.js') }}?v={{ filemtime(public_path('js/leercronica.js')) }}"
  ></script>

  <script
    src="{{ asset('js/buscador.js') }}?v={{ filemtime(public_path('js/buscador.js')) }}"
  ></script>
@endpush