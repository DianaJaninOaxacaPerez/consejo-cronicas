@extends('layouts.modulo')
@section('title', $noticia->titulo . ' - Voces y crónicas Huejutlenses')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}?v=2">
  <link rel="stylesheet" href="{{ asset('css/entrevista.css') }}">
  <style>
    .btn-volver {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #2F9bd8;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 25px;
        transition: color 0.25s ease;
    }
    .btn-volver:hover {
        color: #1C2730;
    }
    .detalle-fecha {
        color: #6FB8E0;
        font-size: 0.9rem;
        margin: 0 0 20px 0;
        font-style: italic;
    }
    .detalle-categoria {
        display: inline-block;
        background: #f1ddc4;
        color: #3E1613;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 999px;
        margin-bottom: 12px;
    }
    .detalle-contenido {
        color: #1C2730;
        font-size: 1.05rem;
        line-height: 1.9;
        text-align: justify;
    }
    .galeria-noticia {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 12px;
        margin-top: 25px;
    }
    .galeria-noticia img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(62, 22, 19, 0.08);
    }
  </style>
@endpush
@section('content')
<section id="galeria">
    <div class="contenido" style="width: 100%; max-width: 100%; display: block; box-sizing: border-box;">
        <div style="width: 95%; max-width: 950px; margin: 0 auto; box-sizing: border-box;">
            <a href="{{ route('noticias') }}" class="btn-volver">&larr; Volver a Noticias</a>
            <article style="background: #ffffff; padding: 35px 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(62, 22, 19, 0.05); border: 1px solid #f1ddc4; box-sizing: border-box;">
                @if($noticia->categoria)
                    <span class="detalle-categoria">{{ $noticia->categoria }}</span>
                @endif
                <h1 style="margin: 0 0 8px 0; font-family: 'Playfair Display', serif; font-size: 2.3rem; line-height: 1.25; color: #3E1613;">
                    {{ $noticia->titulo }}
                </h1>
                @if($noticia->fecha_publicacion)
                    <p class="detalle-fecha">
                        {{ $noticia->fecha_publicacion->format('d/m/Y') }}
                    </p>
                @endif
                <div style="width: 100%; max-height: 480px; overflow: hidden; border-radius: 10px; margin-bottom: 25px;">
                <img src="{{ $noticia->imagen ? Storage::url($noticia->imagen) : 'https://via.placeholder.com/950x480?text=Sin+imagen' }}" alt="{{ $noticia->titulo }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
                <div class="detalle-contenido">
                    {!! nl2br(e($noticia->contenido)) !!}
                </div>

                @if($noticia->imagenesGaleria && $noticia->imagenesGaleria->count() > 0)
                    <div class="galeria-noticia">
                        @foreach($noticia->imagenesGaleria->sortBy('orden') as $img)
                            <img src="{{ Storage::url($img->imagen) }}" alt="Imagen de {{ $noticia->titulo }}">
                        @endforeach
                    </div>
                @endif
            </article>
        </div>
    </div>
</section>
@endsection