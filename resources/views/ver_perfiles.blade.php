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
      overflow: hidden;
      width: 100%;
      max-width: 900px;
      padding: 3rem 4rem 2.75rem;
      border-radius: 22px;
      background: linear-gradient(160deg, rgba(227, 242, 253, 0.75), rgba(187, 222, 251, 0.55));
      backdrop-filter: blur(18px) saturate(140%);
      -webkit-backdrop-filter: blur(18px) saturate(140%);
      border: 1px solid rgba(255, 255, 255, 0.7);
      box-shadow:
        0 12px 40px rgba(21, 60, 94, 0.18),
        0 1px 0 rgba(255, 255, 255, 0.6) inset;
      transition: transform 0.45s cubic-bezier(.22,.9,.32,1),
                  box-shadow 0.45s cubic-bezier(.22,.9,.32,1),
                  border-color 0.45s ease;
    }

    .perfil-card:hover {
      transform: translateY(-6px);
      border-color: #1565C0;
      box-shadow:
        0 22px 55px rgba(21, 60, 94, 0.32),
        0 1px 0 rgba(255, 255, 255, 0.5) inset;
    }

    .perfil-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 55%;
      height: 100%;
      background: linear-gradient(
        120deg,
        transparent,
        rgba(255, 255, 255, 0.55),
        transparent
      );
      pointer-events: none;
      transition: left 0.7s ease;
    }

    .perfil-card:hover::before {
      left: 130%;
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
      background: linear-gradient(135deg, #ffffff, #90CAF9);
      box-shadow: 0 6px 18px rgba(21, 60, 94, 0.28);
      overflow: hidden;
    }

    .perfil-foto-ring img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      transition: transform 0.6s cubic-bezier(.22,.9,.32,1), filter 0.6s ease;
      filter: grayscale(15%);
    }

    .perfil-foto-ring:hover img {
      transform: scale(1.12) rotate(1deg);
      filter: grayscale(0%);
    }

    .perfil-nombre {
      font-family: 'Playfair Display', Georgia, serif;
      font-weight: 700;
      font-size: 2rem;
      letter-spacing: 0.01em;
      color: #2b3644;
      text-align: center;
      margin-bottom: 0.35rem;
      transition: color 0.35s ease;
    }

    .perfil-card:hover .perfil-nombre {
      color: #1565C0;
    }

    .perfil-cargo {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-weight: 500;
      font-size: 1.05rem;
      color: #66748a;
      text-align: center;
      margin-bottom: 2rem;
    }

    .perfil-bio-titulo {
      font-family: 'Playfair Display', Georgia, serif;
      font-weight: 600;
      font-size: 1.1rem;
      color: #2b3644;
      text-align: center;
      position: relative;
      margin-bottom: 1.1rem;
    }

    .perfil-bio-titulo::after {
      content: '';
      display: block;
      width: 42px;
      height: 2px;
      margin: 0.5rem auto 0;
      background: #64B5F6;
      border-radius: 2px;
    }

    .perfil-bio-texto {
      font-family: 'Lora', Georgia, serif;
      font-size: 1.03rem;
      line-height: 1.85;
      color: #3d4756;
      text-align: center;
      max-width: 72ch;
      margin: 0 auto;
    }

    .perfil-volver {
      display: block;
      text-align: center;
      margin-top: 2.5rem;
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
  </style>
@endpush

@section('content')
<section class="container py-5 perfil-wrap">
  <div class="perfil-card">
    @php $fotoDefault = asset('img/default-perfil.png'); @endphp
    <div class="perfil-foto-box">
      <div class="perfil-foto-ring">
        <img src="{{ $cronista->foto ? Storage::url($cronista->foto) : $fotoDefault }}"
             alt="{{ $cronista->nombre }}"
             onerror="this.onerror=null;this.src='{{ $fotoDefault }}';">
      </div>
    </div>

    <h2 class="perfil-nombre">{{ $cronista->nombre_completo }}</h2>
    <p class="perfil-cargo">{{ $cronista->cargo }}</p>

    <h3 class="perfil-bio-titulo">Biografía</h3>
    <p class="perfil-bio-texto">{{ $cronista->biografia }}</p>

    <div class="perfil-volver">
      <a href="{{ route('perfiles') }}">← Regresar a Perfiles</a>
    </div>
  </div>
</section>
@endsection