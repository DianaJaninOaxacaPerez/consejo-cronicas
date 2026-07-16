@extends('admin.layout')

@section('title', 'Panel de Entrevistas')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/entrevista.css') }}">
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <style>
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


<div class="search-box mb-4 mx-auto" style="max-width: 400px;">
  <input
    type="text"
    id="inputBusqueda"
    class="form-control"
    placeholder="Buscar por título o autor..."
  >
</div>

<div class="admin-header">

    <div class="section-title text-center">
        <h2>Entrevistas</h2>
        <p>Administra las entrevistas</p>
    </div>

    <a href="{{ route('admin.entrevistas.create') }}"
       class="admin-add-btn">

        <span>＋</span>
        Agregar contenido

    </a>

</div>
<div class="feed-container">
  @forelse($entrevistas as $entrevista)
    <div class="feed-card">
      <div class="feed-image">
        <img src="{{ Storage::url($entrevista->imagen) }}"
             alt="Entrevista"
             class="evento-foto-clic"
             data-src="{{ Storage::url($entrevista->imagen) }}"
             style="cursor: pointer;">
      </div>

      <div class="feed-info">
        <h3>{{ $entrevista->titulo }}</h3>
        <p style="color: #52626D; line-height: 1.6; margin: 0 0 8px 0;">{{ Str::limit($entrevista->subtitulo, 160) }}</p>

        <div class="acciones-evento">
          <a href="{{ route('admin.entrevistas.edit', $entrevista) }}" class="btn-pill btn-editar-evento">Editar</a>
          <form action="{{ route('admin.entrevistas.destroy', $entrevista) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta entrevista?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-pill btn-borrar-evento">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding: 20px; text-align: center; color: #52626D;">No hay entrevistas registradas en este momento.</p>
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