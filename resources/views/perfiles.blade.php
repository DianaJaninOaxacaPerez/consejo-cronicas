@extends('layouts.modulo')
@section('title', 'Perfiles - Consejo Huejutlense de la Crónica')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <style>
    .perfil-card { text-align: center; text-decoration: none; color: inherit; display: block; }
    .perfil-card img {
      width: 160px; height: 160px; border-radius: 50%;
      object-fit: cover; border: 4px solid #cfe2ff; margin-bottom: 12px;
    }
    .perfil-card h3 { font-size: 1.05rem; margin-bottom: 2px; }
    .perfil-card p { color: #666; font-size: .9rem; }
  </style>
@endpush
@section('content')
<section id="perfiles" class="container py-5">
  <div class="section-title text-center mb-4">
    <h2>Integrantes del Consejo</h2>
    <p>Conoce a quienes preservan nuestra historia</p>
  </div>
  <div class="row g-4">
    @forelse($cronistas as $cronista)
      <div class="col-md-4 col-sm-6">
        <a href="{{ route('perfiles.show', $cronista->id_cronista) }}" class="perfil-card">
          <img src="{{ $cronista->foto ? Storage::url($cronista->foto) : asset('img/default-perfil.png') }}" alt="{{ $cronista->nombre }}">
          <h3>{{ $cronista->nombre_completo }}</h3>
          <p>{{ $cronista->cargo }}</p>
        </a>
      </div>
    @empty
      <p class="text-center">Aún no hay perfiles registrados.</p>
    @endforelse
  </div>
</section>
@endsection