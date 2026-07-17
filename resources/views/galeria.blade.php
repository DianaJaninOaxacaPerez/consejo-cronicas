@extends('layouts.modulo')
@section('title', 'Galería - Voces y crónicas Huejutlenses')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/verfoto.css') }}">
  <style>
    .gallery{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-top:25px;
}
.gallery-item-container{
    width:100%;
}
.gallery-item-container img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:12px;
    cursor:pointer;
    display:block;
    box-shadow:0 4px 12px rgba(0,0,0,.12);
    transition:.3s;
}
.gallery-item-container img:hover{
    transform:scale(1.03);
}
@media (max-width:1200px){
    .gallery{
        grid-template-columns:repeat(3,1fr);
    }
}
@media (max-width:768px){
    .gallery{
        grid-template-columns:repeat(2,1fr);
    }
}
@media (max-width:500px){
    .gallery{
        grid-template-columns:1fr;
    }
}

/* Barra de filtros pública */
.filtros-galeria{
    display:flex;
    align-items:center;
    gap:14px;
    flex-wrap:wrap;
    max-width:1100px;
    margin:0 auto 30px;
}
.filtros-galeria__label{
    font-family:'Poppins',sans-serif;
    font-weight:600;
    color:#33404A;
    font-size:1rem;
    white-space:nowrap;
}
.filtros-galeria__input,
.filtros-galeria__select{
    flex:1;
    min-width:160px;
    padding:10px 16px;
    border:1px solid #DCEBF5;
    border-radius:50px;
    font-family:'Poppins',sans-serif;
    font-size:.9rem;
    color:#33404A;
    background:#fff;
}
.filtros-galeria__input:focus,
.filtros-galeria__select:focus{
    outline:none;
    border-color:#2F9BD8;
    box-shadow:0 0 0 3px rgba(47,155,216,.15);
}
.filtros-galeria__btn{
    flex:0 0 auto;
    width:42px;
    height:42px;
    border-radius:50%;
    border:1px solid #DCEBF5;
    background:#fff;
    color:#33404A;
    font-size:1.3rem;
    line-height:1;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.2s;
}
.filtros-galeria__btn:hover{
    background:#2F9BD8;
    border-color:#2F9BD8;
    color:#fff;
}
.filtros-galeria__limpiar{
    font-family:'Poppins',sans-serif;
    font-size:.8rem;
    color:#A14B31;
    text-decoration:none;
    white-space:nowrap;
}
@media (max-width:768px){
    .filtros-galeria{ justify-content:center; }
}
  </style>
@endpush
@section('content')
<section class="feed-section container py-5">
  <div class="section-title text-center mb-4">
    <h2>Galería Cultural</h2>
  </div>

  <form method="GET" action="{{ route('galeria') }}" class="filtros-galeria">
    <span class="filtros-galeria__label">Filtros</span>

    <input
      type="text"
      name="titulo"
      class="filtros-galeria__input"
      placeholder="Título de la imagen"
      value="{{ request('titulo') }}"
    >

    <input
      type="text"
      name="descripcion"
      class="filtros-galeria__input"
      placeholder="Descripción"
      value="{{ request('descripcion') }}"
    >

    <select name="categoria" class="filtros-galeria__select">
      <option value="">Por categoría</option>
      @foreach($categorias as $valor => $etiqueta)
        <option value="{{ $valor }}" {{ request('categoria') === $valor ? 'selected' : '' }}>
          {{ $etiqueta }}
        </option>
      @endforeach
    </select>

    <button type="submit" class="filtros-galeria__btn" title="Buscar">+</button>

    @if(request()->anyFilled(['titulo','descripcion','categoria']))
      <a href="{{ route('galeria') }}" class="filtros-galeria__limpiar">Limpiar filtros</a>
    @endif
  </form>

  <div class="gallery">
@forelse($imagenes as $foto)
    @php $imgDefault = asset('img/default-galeria.png'); @endphp
    <div
        class="gallery-item-container"
        data-title="{{ $foto->titulo }}"
        data-description="{{ $foto->descripcion }}"
    >
        <img
            src="{{ $foto->ruta_imagen ? Storage::url($foto->ruta_imagen) : $imgDefault }}"
            alt="{{ $foto->titulo }}"
            data-title="{{ $foto->titulo }}"
            data-description="{{ $foto->descripcion }}"
            onerror="this.onerror=null;this.src='{{ $imgDefault }}';"
        >
    </div>
@empty
    <p class="text-center">No se encontraron imágenes con esos filtros.</p>
@endforelse
</div>
</section>
<div class="image-viewer" id="viewer">
  <span id="close-viewer">&times;</span>
  <div class="viewer-content">
    <img id="viewer-img" src="" alt="Visor grande">
    <h2 id="viewer-title"></h2>
    <p id="viewer-description"></p>
  </div>
</div>
@endsection
@push('scripts')
  <script src="{{ asset('js/galeria.js') }}?v={{ filemtime(public_path('js/galeria.js')) }}"></script>
@endpush