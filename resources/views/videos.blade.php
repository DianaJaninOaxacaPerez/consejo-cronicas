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
  </style>
@endpush
@section('content')
<section id="videos" class="container py-5">
  <div class="section-title text-center mb-4">
    <h2>Videos</h2>
    <p>Momentos y tradiciones capturados en video</p>
  </div>
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
      <p class="text-center">Aún no hay videos registrados.</p>
    @endforelse
  </div>
</section>
@endsection