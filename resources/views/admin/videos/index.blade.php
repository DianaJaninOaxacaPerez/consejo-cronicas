@extends('admin.layout')

@section('title', 'Videos (Admin)')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <style>
    .acciones-galeria {
      display: flex; gap: 8px; margin-top: 10px; margin-bottom: 20px;
      justify-content: center; width: 100%;
    }
    .btn-pill {
      display: inline-flex; align-items: center; justify-content: center;
      padding: 6px 18px; border-radius: 50px; font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 700; text-decoration: none;
      border: 1px solid #CFE9FB; cursor: pointer; transition: all .25s ease;
      white-space: nowrap; width: auto; background: none;
    }
    .btn-editar-galeria, .btn-borrar-galeria { background-color: #E3F1FA; color: #33404A; }
    .btn-editar-galeria:hover, .btn-borrar-galeria:hover {
      background-color: #6FB8E0; color: #FFFFFF; border-color: #6FB8E0;
      transform: translateY(-2px); box-shadow: 0 6px 14px rgba(47,155,216,.28);
    }
    .encabezado-galeria-admin { position: relative; margin-bottom: 25px; padding: 0 190px; min-height: 75px; }
    .btn-agregar-galeria {
      position: absolute; top: 5px; right: 0; display: inline-flex; align-items: center;
      justify-content: center; gap: 7px; padding: 10px 22px; border-radius: 50px;
      background-color: #6FB8E0; color: #FFFFFF; border: 1px solid #6FB8E0;
      font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700;
      text-decoration: none; transition: all .25s ease; box-shadow: 0 4px 12px rgba(47,155,216,.25);
    }
    .btn-agregar-galeria:hover {
      background-color: #2F9BD8; border-color: #2F9BD8; color: #FFFFFF;
      transform: translateY(-2px); box-shadow: 0 7px 16px rgba(47,155,216,.35);
    }
    .video-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }
    .video-card {
      background: #fff; border-radius: 14px; overflow: hidden;
      box-shadow: 0 3px 14px rgba(28,39,48,.08); border: 1px solid #EAF3FA;
      display: flex; flex-direction: column;
    }
    .video-card-media {
      height: 160px; background: #0e1b23; display: flex; align-items: center;
      justify-content: center; position: relative;
    }
    .video-card-media video { width: 100%; height: 100%; object-fit: cover; }
    .video-card-media .enlace-icono {
      color: #fff; font-size: 2.5rem;
    }
    .video-card-badge {
      position: absolute; top: 8px; left: 8px; background: rgba(0,0,0,.6);
      color: #fff; font-size: .7rem; padding: 3px 10px; border-radius: 20px;
      text-transform: capitalize;
    }
    .video-card-body { padding: 14px 16px; flex: 1; display: flex; flex-direction: column; }
    .video-card-body h3 { font-family: 'Playfair Display', serif; font-size: 1.05rem; margin: 0 0 6px; }
    .video-card-body p { font-size: .85rem; color: #5C6B75; margin: 0 0 10px; flex: 1; }

    .filtros-videos {
      background: #F7FBFE;
      border: 1px solid #EAF3FA;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 30px;
    }
    .filtros-videos .form-label {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: .82rem;
      color: #33404A;
      margin-bottom: 6px;
    }
    .filtros-videos .form-control,
    .filtros-videos .form-select {
      border-radius: 10px;
      border: 1px solid #CFE9FB;
      padding: 10px 14px;
      font-size: .9rem;
    }
    .filtros-videos .form-control:focus,
    .filtros-videos .form-select:focus {
      border-color: #2F9BD8;
      box-shadow: 0 0 0 .15rem rgba(47,155,216,.15);
    }
    .buscador-clave { position: relative; }
    .buscador-clave i {
      position: absolute; left: 14px; top: 50%;
      transform: translateY(-50%); color: #8FA6B3;
    }
    .buscador-clave input { padding-left: 40px; }

    .btn-filtrar {
      background-color: #2F9BD8;
      border: none;
      color: #fff;
      font-weight: 700;
      border-radius: 10px;
      padding: 10px 24px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all .2s ease;
      height: 44px;
    }
    .btn-filtrar:hover { background-color: #1565C0; color: #fff; }

    @media (max-width: 768px) {
      .encabezado-galeria-admin { padding: 0; display: flex; flex-direction: column; align-items: center; gap: 15px; }
      .btn-agregar-galeria { position: static; }
    }
  </style>
@endpush

@section('content')

<div class="encabezado-galeria-admin">
  <div class="section-title text-center">
    <h2>Videos</h2>
    <p>Videos y enlaces del Consejo Huejutlense</p>
  </div>

  <a href="{{ route('admin.videos.create') }}" class="btn-agregar-galeria">
    <span>＋</span>
    Agregar contenido
  </a>
</div>

@if(session('success'))
  <div class="alert-success" style="text-align:center; margin-bottom:20px;">
    {{ session('success') }}
  </div>
@endif

{{-- 🔍 Barra de filtros --}}
<form method="GET" action="{{ route('admin.videos.index') }}" class="filtros-videos">
  <div class="row g-3 align-items-end">
    <div class="col-lg-4 col-md-12">
      <label class="form-label">&nbsp;</label>
      <div class="buscador-clave">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" class="form-control" placeholder="Buscar por palabra clave..." value="{{ request('q') }}">
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <label class="form-label">Título</label>
      <input type="text" name="titulo" class="form-control" placeholder="Título..." value="{{ request('titulo') }}">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4">
      <label class="form-label">Categoría</label>
      <select name="categoria" class="form-select">
        <option value="">Todas</option>
        @foreach($categorias as $valor => $etiqueta)
          <option value="{{ $valor }}" {{ request('categoria') === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
      <button type="submit" class="btn-filtrar w-100">
        <i class="fa-solid fa-filter"></i> Filtrar
      </button>
    </div>
  </div>
</form>

<div class="video-grid">
  @forelse($videos as $video)
    <div class="video-card">
      <div class="video-card-media">
        <span class="video-card-badge">{{ $video->tipo === 'archivo' ? 'Video' : ($video->plataforma ?? 'Enlace') }}</span>
        @if($video->tipo === 'archivo' && $video->archivo)
          <video src="{{ Storage::url($video->archivo) }}" muted></video>
        @else
          <i class="fa-solid fa-link enlace-icono"></i>
        @endif
      </div>
      <div class="video-card-body">
        <h3>{{ $video->titulo }}</h3>
        <p>{{ \Illuminate\Support\Str::limit($video->descripcion, 90) }}</p>

        <div class="acciones-galeria">
          <a href="{{ route('admin.videos.edit', $video) }}" class="btn-pill btn-editar-galeria">Editar</a>
          <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este video?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-pill btn-borrar-galeria">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding:20px; text-align:center;">Aún no hay videos registrados.</p>
  @endforelse
</div>

@endsection