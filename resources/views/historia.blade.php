@extends('layouts.modulo')

@section('title', 'Historia - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<section id="historia" class="container-fluid px-4 py-5">

  <div class="admin-header">
      <div class="section-title text-center">
          <h2>Historia de Huejutla</h2>
          <p>Conociendo nuestras raíces</p>
      </div>
  </div>

  <form method="GET" action="{{ route('historia') }}" class="filtros-bar">

      <details class="filtro-caja">
          <summary>Por fechas de tal a tal</summary>
          <div class="filtro-panel">
              <label>Desde
                  <input type="date" name="desde" value="{{ request('desde') }}">
              </label>
              <label>Hasta
                  <input type="date" name="hasta" value="{{ request('hasta') }}">
              </label>
          </div>
      </details>

      <details class="filtro-caja">
          <summary>Categoría</summary>
          <div class="filtro-panel filtro-panel--lista">
              <a href="{{ request()->fullUrlWithQuery(['categoria' => null]) }}"
                 class="{{ !request('categoria') ? 'activo' : '' }}">Todas</a>
              @foreach($categorias as $valor => $etiqueta)
                  <a href="{{ request()->fullUrlWithQuery(['categoria' => $valor]) }}"
                     class="{{ request('categoria') === $valor ? 'activo' : '' }}">{{ $etiqueta }}</a>
              @endforeach
          </div>
      </details>

      <a href="{{ request()->fullUrlWithQuery(['orden' => 'reciente']) }}"
         class="filtro-btn {{ request('orden', 'reciente') === 'reciente' ? 'activo' : '' }}">
          Reciente <span>+</span>
      </a>

      <a href="{{ request()->fullUrlWithQuery(['orden' => 'antigua']) }}"
         class="filtro-btn {{ request('orden') === 'antigua' ? 'activo' : '' }}">
          Antigua <span>+</span>
      </a>

      <details class="filtro-caja">
          <summary>Autor</summary>
          <div class="filtro-panel">
              <input type="text" name="autor" placeholder="Nombre del autor" value="{{ request('autor') }}">
          </div>
      </details>

      <input type="text" name="q" class="filtro-buscar" placeholder="Buscar por título..." value="{{ request('q') }}">

      <button type="submit" class="filtro-btn filtro-btn--aplicar">Buscar</button>

      @if(request()->anyFilled(['desde','hasta','categoria','autor','q']) || request('orden') === 'antigua')
          <a href="{{ route('historia') }}" class="filtro-btn filtro-btn--limpiar">Limpiar</a>
      @endif

  </form>

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

            <span class="card-tag">{{ $categorias[$historia->categoria] ?? 'Historia' }}</span>

            <h3 class="historia-publica__titulo">
              {{ $historia->titulo }}
            </h3>

            <p>{{ $historia->descripcion }}</p>

            <small>
              Publicado el
              {{ $historia->fecha_creacion
                  ? $historia->fecha_creacion->format('d/m/Y')
                  : '—' }}
              @if($historia->autor) &middot; Por {{ $historia->autor }} @endif
            </small>

          </div>
        </article>
      </div>

    @empty

      <div class="col-12">
        <p class="text-center">No hay historias registradas con esos filtros.</p>
      </div>

    @endforelse

  </div>

  <div class="mt-4 d-flex justify-content-center">
      {{ $historias->links() }}
  </div>

</section>

@endsection