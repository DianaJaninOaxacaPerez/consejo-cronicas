@extends('admin.layout')

@section('title', 'Historias')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<div class="admin-header">
    <div class="section-title text-center">
        <h2>Historia de Huejutla</h2>
        <p>Conociendo nuestras raíces</p>
    </div>

    <a href="{{ route('admin.historias.create') }}" class="admin-add-btn">
        <span>＋</span>
        Agregar contenido
    </a>
</div>

<form method="GET" action="{{ route('admin.historias.index') }}" class="filtros-bar">

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
        <a href="{{ route('admin.historias.index') }}" class="filtro-btn filtro-btn--limpiar">Limpiar</a>
    @endif

</form>

<div class="cards">
  @forelse($historias as $historia)
    <div class="card historia-card">
      @if($historia->imagen)
        <img src="{{ Storage::url($historia->imagen) }}" alt="{{ $historia->titulo }}">
      @endif

      <div class="card-content">
        <span class="card-tag">{{ $categorias[$historia->categoria] ?? 'Historias' }}</span>
        <h3 class="historia-titulo">{{ $historia->titulo }}</h3>
        <p>{{ $historia->descripcion }}</p>
        <small>
            Publicado el {{ $historia->fecha_creacion ? $historia->fecha_creacion->format('d/m/Y') : '—' }}
            @if($historia->autor) &middot; Por {{ $historia->autor }} @endif
        </small>

        <div class="feed-actions" style="margin-top: 15px; display: flex; gap: 10px;">
          <a href="{{ route('admin.historias.edit', $historia) }}" class="btn-editar">Editar</a>
          <form action="{{ route('admin.historias.destroy', $historia) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar esta historia? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-borrar" style="border:none;cursor:pointer;">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="grid-column: 1/-1; text-align: center; color: #666;">No hay historias registradas con esos filtros.</p>
  @endforelse
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $historias->links() }}
</div>

@endsection