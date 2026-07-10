@extends('layouts.modulo')
@section('title', $entrevista->titulo . ' - Voces y crónicas Huejutlenses')
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
    .detalle-subtitulo {
        color: #33404A;
        font-size: 1.15rem;
        font-style: italic;
        line-height: 1.6;
        margin: 0 0 25px 0;
        border-left: 4px solid #f1ddc4;
        padding-left: 18px;
    }
    .detalle-contenido {
        color: #1C2730;
        font-size: 1.05rem;
        line-height: 1.9;
        text-align: justify;
    }
  </style>
@endpush
@section('content')
<section id="galeria">
    <div class="contenido" style="width: 100%; max-width: 100%; display: block; box-sizing: border-box;">
        <div style="width: 95%; max-width: 950px; margin: 0 auto; box-sizing: border-box;">

            <a href="{{ route('entrevistas') }}" class="btn-volver">&larr; Volver a Entrevistas</a>

            <article style="background: #ffffff; padding: 35px 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(62, 22, 19, 0.05); border: 1px solid #f1ddc4; box-sizing: border-box;">

                <h1 style="margin: 0 0 8px 0; font-family: 'Playfair Display', serif; font-size: 2.3rem; line-height: 1.25; color: #3E1613;">
                    {{ $entrevista->titulo }}
                </h1>

                @if($entrevista->fecha_registro)
                    <p class="detalle-fecha">
                        {{ $entrevista->fecha_registro->format('d/m/Y') }}
                    </p>
                @endif

                <div style="width: 100%; max-height: 480px; overflow: hidden; border-radius: 10px; margin-bottom: 25px;">
                    <img src="{{ asset('img/entrevistas/' . $entrevista->imagen) }}" alt="Imagen" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>

                @if(!empty($entrevista->subtitulo))
                    <p class="detalle-subtitulo">
                        {!! nl2br(e($entrevista->subtitulo)) !!}
                    </p>
                @endif

                <div class="detalle-contenido">
                    {!! nl2br(e($entrevista->contenido)) !!}
                </div>

            </article>

        </div>
    </div>
</section>
@endsection