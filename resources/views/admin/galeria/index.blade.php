@extends('admin.layout')

@section('title', 'Galería Cultural (Admin)')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/verfoto.css') }}">
  <style>
    .acciones-galeria {
        display: flex;
        gap: 8px;
        margin-top: 10px;
        margin-bottom: 20px;
        justify-content: center;
        width: 100%;
    }
    .btn-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 18px;
        border-radius: 50px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid #CFE9FB;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
        width: auto;
        background: none;
    }
    .btn-editar-galeria,
    .btn-borrar-galeria {
        background-color: #E3F1FA;
        color: #33404A;
    }
    .btn-editar-galeria:hover,
    .btn-borrar-galeria:hover {
        background-color: #6FB8E0;
        color: #FFFFFF;
        border-color: #6FB8E0;
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(47,155,216,.28);
    }
  </style>
@endpush

@section('content')

<div class="section-title text-center mb-4">
  <h2>Galería Cultural (Admin)</h2>
  <p>Fotografías y recuerdos de Huejutla</p>
</div>

<div class="search-box mb-4 mx-auto" style="max-width: 400px;">
  <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
</div>

<div class="gallery">
  @foreach($imagenes as $foto)
    <div class="gallery-item-container" style="display: flex; flex-direction: column; align-items: center;">
      <img
        src="{{ Storage::url($foto->ruta_imagen) }}"
        data-title="{{ $foto->titulo }}"
        data-description="{{ $foto->descripcion }}"
        style="cursor: pointer;">

      <div class="acciones-galeria">
        <a href="{{ route('admin.galeria.edit', $foto) }}" class="btn-pill btn-editar-galeria">Editar</a>
        <form action="{{ route('admin.galeria.destroy', $foto) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta imagen de la galería?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-pill btn-borrar-galeria">Borrar</button>
        </form>
      </div>
    </div>
  @endforeach
</div>

<div class="image-viewer" id="viewer">
  <span id="close-viewer">&times;</span>
  <div class="viewer-content">
    <img id="viewer-img">
    <h2 id="viewer-title"></h2>
    <p id="viewer-description"></p>
  </div>
</div>

<div class="card admin-card" style="margin-top: 30px;">
  <div class="card-content">
    <h3>Agregar Contenido</h3>
    <p>Administre la galería.</p>
    <a href="{{ route('admin.galeria.create') }}" class="btn-admin">Agregar</a>
  </div>
</div>

@endsection

@push('scripts')
  <script src="{{ asset('js/galeria.js') }}"></script>
  <script src="{{ asset('js/buscador.js') }}"></script>
@endpush