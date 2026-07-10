@extends('admin.layout')

@section('title', 'Historias')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<div class="section-title text-center mb-4">
  <h2>Historia de Huejutla</h2>
  <p>Conociendo nuestras raíces</p>
</div>

<div class="search-box mb-4 mx-auto" style="max-width: 400px;">
  <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
</div>

<div class="cards">

  @forelse($historias as $historia)
    <div class="card historia-card">
      @if($historia->imagen)
        <img src="{{ Storage::url($historia->imagen) }}" alt="{{ $historia->titulo }}">
      @endif

      <div class="card-content">
        <h3 class="historia-titulo">{{ $historia->titulo }}</h3>
        <p>{{ $historia->descripcion }}</p>
        <small>Publicado el {{ $historia->fecha_creacion ? $historia->fecha_creacion->format('d/m/Y') : '—' }}</small>

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
    <p style="grid-column: 1/-1; text-align: center; color: #666;">No hay historias registradas.</p>
  @endforelse

  <div class="card admin-card">
    <div class="card-content">
      <h3>Agregar Contenido</h3>
      <p>Administre la historia.</p>
      <a href="{{ route('admin.historias.create') }}" class="btn-admin">Agregar</a>
    </div>
  </div>

</div>

@endsection