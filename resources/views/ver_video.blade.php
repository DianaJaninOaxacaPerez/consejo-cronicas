@extends('layouts.modulo')
@section('title', $video->titulo . ' - Consejo Huejutlense de la Crónica')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Lora:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

  <style>
    .video-wrap {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 3rem 1.5rem;
    }

    .video-detalle-card {
      position: relative;
      overflow: hidden;
      width: 100%;
      max-width: 900px;
      padding: 2.5rem 3rem 2.75rem;
      border-radius: 22px;
      background: linear-gradient(160deg, rgba(227, 242, 253, 0.75), rgba(187, 222, 251, 0.55));
      backdrop-filter: blur(18px) saturate(140%);
      -webkit-backdrop-filter: blur(18px) saturate(140%);
      border: 1px solid rgba(255, 255, 255, 0.7);
      box-shadow:
        0 12px 40px rgba(21, 60, 94, 0.18),
        0 1px 0 rgba(255, 255, 255, 0.6) inset;
    }

    .video-player-box {
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 1.75rem;
      box-shadow: 0 6px 18px rgba(21, 60, 94, 0.22);
      background: #000;
    }

    .video-player-box video {
      width: 100%;
      display: block;
      max-height: 520px;
    }

    .video-titulo {
      font-family: 'Playfair Display', Georgia, serif;
      font-weight: 700;
      font-size: 1.9rem;
      color: #2b3644;
      text-align: center;
      margin-bottom: 0.35rem;
    }

    .video-meta {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-weight: 500;
      font-size: 1rem;
      color: #66748a;
      text-align: center;
      margin-bottom: 2rem;
    }

    .video-descripcion-titulo {
      font-family: 'Playfair Display', Georgia, serif;
      font-weight: 600;
      font-size: 1.1rem;
      color: #2b3644;
      text-align: center;
      position: relative;
      margin-bottom: 1.1rem;
    }

    .video-descripcion-titulo::after {
      content: '';
      display: block;
      width: 42px;
      height: 2px;
      margin: 0.5rem auto 0;
      background: #64B5F6;
      border-radius: 2px;
    }

    .video-descripcion-texto {
      font-family: 'Lora', Georgia, serif;
      font-size: 1.03rem;
      line-height: 1.85;
      color: #3d4756;
      text-align: center;
      max-width: 72ch;
      margin: 0 auto;
    }

    .video-volver {
      display: block;
      text-align: center;
      margin-top: 2.5rem;
    }

    .video-volver a {
      font-family: 'Lora', Georgia, serif;
      font-style: italic;
      font-size: 0.95rem;
      color: #4a5568;
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: border-color 0.25s ease, color 0.25s ease;
    }

    .video-volver a:hover {
      color: #2b3644;
      border-color: #2b3644;
    }
  </style>
@endpush

@section('content')
<section class="container py-5 video-wrap">
  <div class="video-detalle-card">

    <div class="video-player-box">
      <video src="{{ Storage::url($video->archivo) }}" controls></video>
    </div>

    <h2 class="video-titulo">{{ $video->titulo }}</h2>
    <p class="video-meta">
            {{ \App\Models\Video::CATEGORIAS[$video->categoria] ?? $video->categoria }}
             @if($video->autor) · {{ $video->autor }} @endif
    </p>
   
    @if($video->descripcion)
      <h3 class="video-descripcion-titulo">Descripción</h3>
      <p class="video-descripcion-texto">{{ $video->descripcion }}</p>
    @endif

    <div class="video-volver">
      <a href="{{ route('videos') }}">← Regresar a Videos</a>
    </div>
  </div>
</section>
@endsection