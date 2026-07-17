@extends('layouts.modulo')

@section('title', 'Historia - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<section id="historia" class="container-fluid px-4 py-5">

  <div class="section-title text-center mb-4">
    <h2>Historia de Huejutla</h2>
    <p>Conociendo nuestras raíces</p>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 500px;">
    <input
      type="text"
      id="inputBusqueda"
      class="form-control"
      placeholder="Buscar por título..."
    >
  </div>

  <div class="historias-grid">

    @forelse($historias as $historia)

      <div class="historia-item">
        <article class="historia-publica h-100">

          @if($historia->imagen)
            <img
              src="{{ Storage::url($historia->imagen) }}"
              class="historia-publica__imagen"
              alt="{{ $historia->titulo }}"
            >
          @endif

          <div class="historia-publica__contenido">

            <h3 class="historia-publica__titulo">
              {{ $historia->titulo }}
            </h3>

            <p>{{ $historia->descripcion }}</p>

            <small>
              Publicado el
              {{ $historia->fecha_creacion
                  ? $historia->fecha_creacion->format('d/m/Y')
                  : '—' }}
            </small>

          </div>
        </article>
      </div>

    @empty

      <div class="col-12">
        <p class="text-center">No hay historias registradas aún.</p>
      </div>

    @endforelse

  </div>

</section>

@endsection

@push('scripts')
  <script src="{{ asset('js/buscador.js') }}?v={{ filemtime(public_path('js/buscador.js')) }}"></script>
@endpush