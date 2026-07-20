@extends('layouts.modulo')
@section('title', 'Videos - Consejo Huejutlense de la Crónica')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <style>
    .video-card {
      text-decoration: none;
      color: inherit;
      display: block;
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #EAF3FA;
      box-shadow: 0 3px 14px rgba(28,39,48,.08);
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .video-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 26px rgba(28,39,48,.14);
    }
    .video-card-media {
      height: 190px;
      background: #0e1b23;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }
    .video-card-media video {
      width: 100%;
      height: 100%;
      object-fit: cover;
      pointer-events: none;
    }
    .video-card-media .play-icon,
    .video-card-media .enlace-icon {
      color: #fff;
      font-size: 2.8rem;
      position: relative;
      z-index: 2;
      opacity: .9;
    }
    .video-card-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background: rgba(0,0,0,.6);
      color: #fff;
      font-size: .7rem;
      padding: 4px 12px;
      border-radius: 20px;
      text-transform: capitalize;
      z-index: 2;
    }
    .video-card-body { padding: 16px 18px; }
    .video-card-categoria {
      display: inline-block;
      background: #E3F1FA;
      color: #1565C0;
      font-size: .72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .03em;
      padding: 3px 12px;
      border-radius: 20px;
      margin-bottom: 8px;
    }
    .video-card-body h3 {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.1rem;
      margin-bottom: 6px;
    }
    .video-card-body p {
      color: #666;
      font-size: .9rem;
      margin: 0;
    }

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

    /* 🔍 Buscador con lupa (fix: la lupa ya no tapa el texto) */
    .buscador-clave { position: relative; }
    .buscador-clave i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #8FA6B3;
      font-size: 0.9rem;
      pointer-events: none;
      z-index: 2;
    }
    .buscador-clave input {
      padding-left: 42px !important;
    }

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

    /* 🧹 Botón limpiar filtros */
    .btn-limpiar {
      background-color: transparent;
      border: 1px solid #CFE9FB;
      color: #33404A;
      font-weight: 600;
      border-radius: 10px;
      padding: 10px 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all .2s ease;
      height: 44px;
      text-decoration: none;
      white-space: nowrap;
    }
    .btn-limpiar:hover {
      background-color: #F0F7FC;
      border-color: #2F9BD8;
      color: #1565C0;
    }
  </style>
@endpush

@section('content')
<section id="videos" class="container py-5">
  <div class="section-title text-center mb-4">
    <h2>Videos</h2>
    <p>Momentos y tradiciones capturados en video</p>
  </div>

  {{-- 🔍 Barra de filtros --}}
  <form method="GET" action="{{ route('videos') }}" class="filtros-videos">
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
      <div class="col-lg-2 col-md-4 col-sm-4">
        <label class="form-label">Categoría</label>
        <select name="categoria" class="form-select">
          <option value="">Todas</option>
          @foreach($categorias as $valor => $etiqueta)
            <option value="{{ $valor }}" {{ request('categoria') === $valor ? 'selected' : '' }}>{{ $etiqueta }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-lg-2 col-md-3 col-sm-6">
        <button type="submit" class="btn-filtrar w-100">
          <i class="fa-solid fa-filter"></i> Filtrar
        </button>
      </div>
      <div class="col-lg-1 col-md-3 col-sm-6">
        <a href="{{ route('videos') }}" class="btn-limpiar w-100">
          <i class="fa-solid fa-xmark"></i> Limpiar
        </a>
      </div>
    </div>
  </form>

  <div class="row g-4">
    @forelse($videos as $video)
      <div class="col-md-4 col-sm-6">
        @if($video->tipo === 'enlace')
          <a href="{{ $video->url }}" target="_blank" rel="noopener" class="video-card">
            <div class="video-card-media">
              <span class="video-card-badge">{{ \App\Models\Video::PLATAFORMAS[$video->plataforma] ?? 'Enlace' }}</span>
              <i class="fa-solid fa-arrow-up-right-from-square enlace-icon"></i>
            </div>
            <div class="video-card-body">
              <span class="video-card-categoria">{{ \App\Models\Video::CATEGORIAS[$video->categoria] ?? $video->categoria }}</span>
              <h3>{{ $video->titulo }}</h3>
              <p>{{ \Illuminate\Support\Str::limit($video->descripcion, 80) }}</p>
            </div>
          </a>
        @else
          <a href="{{ route('videos.show', $video->id_video) }}" class="video-card">
            <div class="video-card-media">
              <span class="video-card-badge">Video</span>
              @if($video->archivo)
                <video src="{{ Storage::url($video->archivo) }}" muted></video>
              @endif
              <i class="fa-solid fa-circle-play play-icon" style="position:absolute;"></i>
            </div>
            <div class="video-card-body">
              <span class="video-card-categoria">{{ \App\Models\Video::CATEGORIAS[$video->categoria] ?? $video->categoria }}</span>
              <h3>{{ $video->titulo }}</h3>
              <p>{{ \Illuminate\Support\Str::limit($video->descripcion, 80) }}</p>
            </div>
          </a>
        @endif
      </div>
    @empty
      <p class="text-center">No se encontraron videos con esos filtros.</p>
    @endforelse
  </div>
</section>
@endsection