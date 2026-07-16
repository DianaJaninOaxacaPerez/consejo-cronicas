@extends('admin.layout')

@section('title', 'Panel de Eventos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/eventos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <style>
    .encabezado-eventos-admin {
    position: relative;
    margin-bottom: 30px;
    padding: 0 190px;
    min-height: 75px;
}

.btn-agregar-evento {
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
    white-space: nowrap;

    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(47, 155, 216, 0.25);
}

.btn-agregar-evento:hover {
    background-color: #2F9BD8;
    border-color: #2F9BD8;
    color: #FFFFFF;
    transform: translateY(-2px);
    box-shadow: 0 7px 16px rgba(47, 155, 216, 0.35);
}

@media (max-width: 768px) {
    .encabezado-eventos-admin {
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .btn-agregar-evento {
        position: static;
    }
}
    .acciones-evento {
        display: flex;
        gap: 8px;
        margin-top: 15px;
        justify-content: flex-start;
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
    .btn-editar-evento,
    .btn-borrar-evento {
        background-color: #E3F1FA;
        color: #33404A;
    }
    .btn-editar-evento:hover,
    .btn-borrar-evento:hover {
        background-color: #6FB8E0;
        color: #FFFFFF;
        border-color: #6FB8E0;
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(47,155,216,.28);
    }
  </style>
@endpush

@section('content')


<div class="encabezado-eventos-admin">

  <div class="section-title text-center">
    <h2>Panel de Eventos</h2>
    <p>Administra las novedades culturales</p>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
  <input
    type="text"
    id="inputBusqueda"
    class="form-control"
    placeholder="Buscar por título o autor..."
  >
</div>


  <a href="{{ route('admin.eventos.create') }}"
     class="btn-agregar-evento">
    <span>＋</span>
    Agregar contenido
  </a>

</div>

<div class="feed-container">
  @forelse($eventos as $evento)
    <div class="feed-card">
      <div class="feed-image">
        <img src="{{ Storage::url($evento->imagen) }}"
             alt="Evento"
             class="evento-foto-clic"
             data-src="{{ Storage::url($evento->imagen) }}"
             style="cursor: pointer;">
      </div>

      <div class="feed-info">
        <span class="tag tag-evento" style="color: #1D6FA0; font-weight: bold; font-size: 15px;">
          {{ $evento->fecha->translatedFormat('d M Y') }}
        </span>
        <h3>{{ $evento->nombre }}</h3>
        <p style="margin: 0 0 8px 0;"><strong>Lugar:</strong> {{ $evento->lugar }}</p>
        <p style="color: #52626D; line-height: 1.6; margin: 0;">{{ $evento->descripcion }}</p>

        <div class="acciones-evento">
          <a href="{{ route('admin.eventos.edit', $evento) }}" class="btn-pill btn-editar-evento">Editar</a>
          <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este evento?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-pill btn-borrar-evento">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding: 20px; text-align: center; color: #52626D;">No hay eventos registrados en este momento.</p>
  @endforelse
</div>

<div class="image-viewer" id="viewer" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; justify-content: center; align-items: center;">
    <span id="close-viewer" style="position: absolute; top: 20px; right: 30px; color: #fff; font-size: 40px; cursor: pointer; font-weight: bold;">&times;</span>
    <img id="viewer-img" src="" alt="Imagen Ampliada" style="max-width: 90%; max-height: 90%; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
</div>

@endsection

@push('scripts')
<script>
    const viewer = document.getElementById('viewer');
    const viewerImg = document.getElementById('viewer-img');
    const closeViewer = document.getElementById('close-viewer');
    document.querySelectorAll('.evento-foto-clic').forEach(img => {
        img.addEventListener('click', function() {
            viewerImg.src = this.dataset.src;
            viewer.style.display = 'flex';
        });
    });
    closeViewer.addEventListener('click', () => {
        viewer.style.display = 'none';
    });
    viewer.addEventListener('click', (e) => {
        if(e.target === viewer) {
            viewer.style.display = 'none';
        }
    });
</script>
<script src="{{ asset('js/buscador.js') }}"></script>
@endpush