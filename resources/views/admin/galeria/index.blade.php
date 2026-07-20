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
      box-shadow: 0 6px 14px rgba(47, 155, 216, 0.28);
    }

    .encabezado-galeria-admin {
      position: relative;
      margin-bottom: 25px;
      padding: 0 190px;
      min-height: 75px;
    }

    .btn-agregar-galeria {
      position: absolute;
      top: 5px;
      right: 0;

      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 7px;

      padding: 10px 22px;
      border-radius: 50px;
      background-color: #6FB8E0;
      color: #FFFFFF;
      border: 1px solid #6FB8E0;

      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 700;
      text-decoration: none;

      transition: all 0.25s ease;
      box-shadow: 0 4px 12px rgba(47, 155, 216, 0.25);
    }

    .btn-agregar-galeria:hover {
      background-color: #2F9BD8;
      border-color: #2F9BD8;
      color: #FFFFFF;
      transform: translateY(-2px);
      box-shadow: 0 7px 16px rgba(47, 155, 216, 0.35);
    }

    /* Barra de filtros */
    .filtros-galeria {
      display: flex;
      align-items: center;
      gap: 14px;
      flex-wrap: wrap;
      max-width: 1100px;
      margin: 0 auto 30px;
    }

    .filtros-galeria__label {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      color: #33404A;
      font-size: 1rem;
      white-space: nowrap;
    }

    .filtros-galeria__input,
    .filtros-galeria__select {
      flex: 1;
      min-width: 160px;
      padding: 10px 16px;
      border: 1px solid #DCEBF5;
      border-radius: 50px;
      font-family: 'Poppins', sans-serif;
      font-size: 0.9rem;
      color: #33404A;
      background: #FFFFFF;
    }

    .filtros-galeria__input:focus,
    .filtros-galeria__select:focus {
      outline: none;
      border-color: #2F9BD8;
      box-shadow: 0 0 0 3px rgba(47, 155, 216, 0.15);
    }

    .filtros-galeria__btn {
      flex: 0 0 auto;
      width: 42px;
      height: 42px;
      border-radius: 50%;
      border: 1px solid #DCEBF5;
      background: #FFFFFF;
      color: #33404A;
      font-size: 1.3rem;
      cursor: pointer;

      display: flex;
      align-items: center;
      justify-content: center;

      transition: 0.2s ease;
    }

    .filtros-galeria__btn:hover {
      background: #2F9BD8;
      border-color: #2F9BD8;
      color: #FFFFFF;
    }

    .filtros-galeria__limpiar {
      font-family: 'Poppins', sans-serif;
      font-size: 0.82rem;
      color: #A14B31;
      text-decoration: none;
      white-space: nowrap;
    }

    .filtros-galeria__limpiar:hover {
      text-decoration: underline;
    }

    .mensaje-sin-resultados {
      grid-column: 1 / -1;
      width: 100%;
      padding: 40px 15px;
      text-align: center;
      color: #52626D;
    }

    @media (max-width: 768px) {
      .encabezado-galeria-admin {
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
      }

      .btn-agregar-galeria {
        position: static;
      }

      .filtros-galeria {
        justify-content: center;
      }
    }
  </style>
@endpush

@section('content')

<div class="encabezado-galeria-admin">

  <div class="section-title text-center">
    <h2>Galería Cultural (Admin)</h2>
    <p>Fotografías y recuerdos de Huejutla</p>
  </div>

  <a
    href="{{ route('admin.galeria.create') }}"
    class="btn-agregar-galeria"
  >
    <span>＋</span>
    Agregar contenido
  </a>

</div>

<form
  method="GET"
  action="{{ route('admin.galeria.index') }}"
  class="filtros-galeria"
>
  <span class="filtros-galeria__label">
    Filtros
  </span>

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

  <select
    name="categoria"
    class="filtros-galeria__select"
  >
    <option value="">
      Por categoría
    </option>

    @foreach($categorias as $valor => $etiqueta)
      <option
        value="{{ $valor }}"
        {{ request('categoria') === $valor ? 'selected' : '' }}
      >
        {{ $etiqueta }}
      </option>
    @endforeach
  </select>

  <button
    type="submit"
    class="filtros-galeria__btn"
    title="Aplicar filtros"
  >
    +
  </button>

  @if(request()->anyFilled(['titulo', 'descripcion', 'categoria']))
    <a
      href="{{ route('admin.galeria.index') }}"
      class="filtros-galeria__limpiar"
    >
      Limpiar filtros
    </a>
  @endif
</form>

<div class="gallery">

  @forelse($imagenes as $foto)

    <div
      class="gallery-item-container"
      style="display: flex; flex-direction: column; align-items: center;"
    >
      <img
        src="{{ Storage::url($foto->ruta_imagen) }}"
        alt="{{ $foto->titulo }}"
        data-title="{{ $foto->titulo }}"
        data-description="{{ $foto->descripcion }}"
        style="cursor: pointer;"
      >

      <div class="acciones-galeria">

        <a
          href="{{ route('admin.galeria.edit', $foto) }}"
          class="btn-pill btn-editar-galeria"
        >
          Editar
        </a>

        <form
          action="{{ route('admin.galeria.destroy', $foto) }}"
          method="POST"
          onsubmit="return confirm('¿Seguro que deseas eliminar esta imagen de la galería?');"
        >
          @csrf
          @method('DELETE')

          <button
            type="submit"
            class="btn-pill btn-borrar-galeria"
          >
            Borrar
          </button>
        </form>

      </div>
    </div>

  @empty

    <p class="mensaje-sin-resultados">
      No se encontraron imágenes con esos filtros.
    </p>

  @endforelse

</div>

<div class="image-viewer" id="viewer">
  <span id="close-viewer">&times;</span>

  <div class="viewer-content">
    <img id="viewer-img" alt="Imagen ampliada">
    <h2 id="viewer-title"></h2>
    <p id="viewer-description"></p>
  </div>
</div>

@endsection

@push('scripts')
  <script
    src="{{ asset('js/galeria.js') }}?v={{ filemtime(public_path('js/galeria.js')) }}"
  ></script>
@endpush