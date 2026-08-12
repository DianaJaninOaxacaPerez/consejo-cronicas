@extends('layouts.modulo')

@section('title', 'Plataformas - Consejo Huejutlense de la Crónica')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">

<style>
    .plataformas-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 30px;
    }

    .plataforma-card {
        text-align: center;
        padding: 25px;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,.10);
    }

    .plataforma-card img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }

    .plataforma-card h3 {
        margin-bottom: 15px;
    }

    .plataforma-botones {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .plataforma-botones a {
        padding: 8px 18px;
        border-radius: 50px;
        text-decoration: none;
        color: white;
        font-weight: 600;
    }

    .btn-youtube {
        background: #ff0000;
    }

    .btn-facebook {
        background: #1877f2;
    }
</style>
@endpush

@section('content')

<section class="container py-5">

    <div class="section-title text-center mb-4">
        <h2>Plataformas</h2>
        <p>Conoce las plataformas de nuestros cronistas</p>
    </div>

    <div class="plataformas-grid">

        @foreach($cronistas as $cronista)

            <div class="plataforma-card">

                <img
                    src="{{ $cronista->foto
                        ? Storage::url($cronista->foto)
                        : asset('img/default-perfil.png') }}"
                    alt="{{ $cronista->nombre_completo }}"
                >

                <h3>{{ $cronista->nombre_completo }}</h3>

                <div class="plataforma-botones">

                    <a href="#" class="btn-youtube">
                        YouTube
                    </a>

                    <a href="#" class="btn-facebook">
                        Facebook
                    </a>

                </div>

            </div>

        @endforeach

    </div>

</section>

@endsection