@extends('layouts.modulo')
@section('title', $cronista->nombre_completo . ' - Consejo Huejutlense de la Crónica')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Lora:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

  <style>
    .perfil-wrap {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 3rem 1.5rem;
    }

    .perfil-card {
      position: relative;
      width: 100%;
      max-width: 820px;
      padding: 3rem 3.5rem 2.75rem;
      border-radius: 22px;
      background: linear-gradient(160deg, #F7F9FB, #EDF1F5);
      border: 1px solid rgba(100, 120, 140, 0.2);
      box-shadow: 0 12px 40px rgba(30, 45, 60, 0.10);
      transition: box-shadow 0.35s ease;
    }

    .perfil-card:hover {
      box-shadow: 0 18px 48px rgba(30, 45, 60, 0.14);
    }

    .perfil-foto-box {
      display: flex;
      justify-content: center;
      margin-bottom: 1.5rem;
    }

    .perfil-foto-ring {
      width: 168px;
      height: 168px;
      border-radius: 50%;
      padding: 4px;
      background: linear-gradient(135deg, #ffffff, #C7D4DE);
      box-shadow: 0 6px 18px rgba(30, 45, 60, 0.18);
      overflow: hidden;
      flex-shrink: 0;
      cursor: pointer;
    }

    .perfil-foto-ring img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      transition: transform 0.3s ease;
    }

    .perfil-foto-ring:hover img {
      transform: scale(1.06);
    }

    .perfil-nombre {
      font-family: 'Playfair Display', Georgia, serif;
      font-weight: 700;
      font-size: 2rem;
      letter-spacing: 0.01em;
      color: #2b3644;
      text-align: center;
      margin-bottom: 0.35rem;
    }

    .perfil-cargo {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-weight: 500;
      font-size: 1.05rem;
      color: #6b7684;
      text-align: center;
      margin-bottom: 2.25rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid rgba(70, 90, 110, 0.15);
    }

    .perfil-bio-titulo {
      font-family: 'Playfair Display', Georgia, serif;
      font-weight: 600;
      font-size: 1.15rem;
      color: #2b3644;
      text-align: center;
      position: relative;
      margin-bottom: 1.75rem;
    }

    .perfil-bio-titulo::after {
      content: '';
      display: block;
      width: 42px;
      height: 2px;
      margin: 0.6rem auto 0;
      background: #7A93A8;
      border-radius: 2px;
    }

    .perfil-bio-texto {
      font-family: 'Lora', Georgia, serif;
      font-size: 1.05rem;
      line-height: 1.9;
      color: #3d4756;
      text-align: justify;
      max-width: 65ch;
      margin: 0 auto;
    }

    .perfil-bio-texto p {
      margin-bottom: 1.4rem;
    }

    .perfil-bio-texto p:last-child {
      margin-bottom: 0;
    }

    .perfil-volver {
      display: block;
      text-align: center;
      margin-top: 2.75rem;
      padding-top: 1.75rem;
      border-top: 1px solid rgba(70, 90, 110, 0.15);
    }

    .perfil-volver a {
      font-family: 'Lora', Georgia, serif;
      font-style: italic;
      font-size: 0.95rem;
      color: #4a5568;
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: border-color 0.25s ease, color 0.25s ease;
    }

    .perfil-volver a:hover {
      color: #2b3644;
      border-color: #2b3644;
    }

    /* Modal de zoom para la foto */
    .foto-modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(20, 20, 20, 0.85);
      z-index: 9999;
      align-items: center;
      justify-content: center;
      cursor: zoom-out;
      padding: 2rem;
    }

    .foto-modal-overlay.activo {
      display: flex;
    }

    .foto-modal-overlay img {
      max-width: 90vw;
      max-height: 85vh;
      border-radius: 12px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
      object-fit: contain;
    }

    .foto-modal-cerrar {
      position: absolute;
      top: 24px;
      right: 32px;
      color: #fff;
      font-size: 2.2rem;
      cursor: pointer;
      line-height: 1;
    }

    @media (max-width: 600px) {
      .perfil-card {
        padding: 2.25rem 1.5rem 2rem;
      }
      .perfil-nombre {
        font-size: 1.6rem;
      }
      .perfil-bio-texto {
        text-align: left;
        font-size: 1rem;
      }
    }
  </style>
@endpush

@section('content')
<section class="container py-5 perfil-wrap">
  <div class="perfil-card">
    @php
      $fotoDefault = asset('img/default-perfil.png');
      $fotoSrc = $cronista->foto ? Storage::url($cronista->foto) : $fotoDefault;

      // Divide la biografía en párrafos legibles (cada 3 oraciones aprox.)
      $oraciones = preg_split('/(?<=[.!?])\s+(?=[A-ZÁÉÍÓÚÑ])/u', trim($cronista->biografia));
      $parrafos = array_chunk($oraciones, 3);
    @endphp

    <div class="perfil-foto-box">
      <div class="perfil-foto-ring" id="abrirFotoModal">
        <img src="{{ $fotoSrc }}"
             alt="{{ $cronista->nombre }}"
             onerror="this.onerror=null;this.src='{{ $fotoDefault }}';">
      </div>
    </div>

    <h2 class="perfil-nombre">{{ $cronista->nombre_completo }}</h2>
    <p class="perfil-cargo">{{ $cronista->cargo }}</p>

    <h3 class="perfil-bio-titulo">Biografía</h3>
    <div class="perfil-bio-texto">
      @foreach($parrafos as $parrafo)
        <p>{{ implode(' ', $parrafo) }}</p>
      @endforeach
    </div>

    <div class="perfil-volver">
      <a href="{{ route('perfiles') }}">← Regresar a Perfiles</a>
    </div>
  </div>
</section>

<div class="foto-modal-overlay" id="fotoModal">
  <span class="foto-modal-cerrar">&times;</span>
  <img src="{{ $fotoSrc }}" alt="{{ $cronista->nombre }}">
</div>
@endsection

@push('scripts')
<script>
  const abrirBtn = document.getElementById('abrirFotoModal');
  const modal = document.getElementById('fotoModal');

  abrirBtn.addEventListener('click', function () {
    modal.classList.add('activo');
  });

  modal.addEventListener('click', function () {
    modal.classList.remove('activo');
  });
</script>
@endpush