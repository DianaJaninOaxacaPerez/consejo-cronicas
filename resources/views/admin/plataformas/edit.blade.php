@extends('admin.layout')

@section('title', 'Editar Plataforma (Admin)')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <style>
    .form-card {
      background: #fff; border-radius: 14px; padding: 30px;
      box-shadow: 0 3px 14px rgba(28,39,48,.08); border: 1px solid #EAF3FA;
      max-width: 600px; margin: 0 auto;
    }
    .form-card label {
      font-family: 'Poppins', sans-serif; font-weight: 600; font-size: .85rem;
      color: #33404A; margin-bottom: 6px; display: block;
    }
    .form-card .form-control {
      border-radius: 10px; border: 1px solid #CFE9FB; padding: 10px 14px;
      font-size: .9rem; margin-bottom: 18px; width: 100%;
    }
    .form-card .form-control:focus {
      border-color: #2F9BD8; box-shadow: 0 0 0 .15rem rgba(47,155,216,.15); outline: none;
    }
    .btn-guardar {
      background-color: #2F9BD8; border: none; color: #fff; font-weight: 700;
      border-radius: 10px; padding: 10px 26px; display: inline-flex; align-items: center;
      gap: 8px; transition: all .2s ease;
    }
    .btn-guardar:hover { background-color: #1565C0; color: #fff; }
    .btn-cancelar {
      color: #5C6B75; font-weight: 600; padding: 10px 20px; text-decoration: none;
    }
    .error-msg { color: #d32f2f; font-size: .8rem; margin-top: -12px; margin-bottom: 14px; }
    .foto-actual {
      width: 90px; height: 90px; border-radius: 50%; object-fit: cover;
      margin-bottom: 14px; display: block;
    }
  </style>
@endpush

@section('content')

<div class="section-title text-center mb-4">
  <h2>Editar Plataforma</h2>
  <p>{{ $plataforma->nombre }}</p>
</div>

<div class="form-card">

  @if($plataforma->foto)
    <img src="{{ Storage::url($plataforma->foto) }}" alt="{{ $plataforma->nombre }}" class="foto-actual">
  @endif

  <form method="POST" action="{{ route('admin.plataformas.update', $plataforma) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $plataforma->nombre) }}" required>
    @error('nombre') <div class="error-msg">{{ $message }}</div> @enderror

    <label for="foto">Cambiar foto</label>
    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
    @error('foto') <div class="error-msg">{{ $message }}</div> @enderror

    <label for="youtube_url">Enlace de YouTube</label>
    <input type="url" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://youtube.com/..." value="{{ old('youtube_url', $plataforma->youtube_url) }}">
    @error('youtube_url') <div class="error-msg">{{ $message }}</div> @enderror

    <label for="facebook_url">Enlace de Facebook</label>
    <input type="url" name="facebook_url" id="facebook_url" class="form-control" placeholder="https://facebook.com/..." value="{{ old('facebook_url', $plataforma->facebook_url) }}">
    @error('facebook_url') <div class="error-msg">{{ $message }}</div> @enderror

    <div class="d-flex align-items-center gap-2 mt-3">
      <button type="submit" class="btn-guardar">Guardar cambios</button>
      <a href="{{ route('admin.plataformas.index') }}" class="btn-cancelar">Cancelar</a>
    </div>
  </form>
</div>

@endsection