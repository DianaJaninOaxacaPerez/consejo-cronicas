@extends('admin.layout')

@section('title', 'Agregar Historia')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="upload-container">

    <a href="{{ route('admin.historias.index') }}" class="btn-volver-fixed">
        ← Volver
    </a>

    <div class="upload-card">

        <h1>Agregar Historia</h1>
        <p>Registra acontecimientos e historias de Huejutla.</p>

        <form method="POST" action="{{ route('admin.historias.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label>Título de la historia</label>
                <input type="text" name="titulo" required placeholder="Ej. Historia del Xantolo" value="{{ old('titulo') }}">
            </div>

            <div class="input-group">
                <label>Descripción corta</label>
                <input type="text" name="descripcion" required placeholder="Breve descripción de la historia" value="{{ old('descripcion') }}">
            </div>

            <div class="input-group">
                <label>Fecha</label>
                <input type="date" name="fecha" required value="{{ old('fecha') }}">
            </div>

            <div class="input-group">
                <label>Fotografía principal</label>
                <input type="file" name="imagen" accept="image/*" required>
            </div>

            <button type="submit" class="btn-upload">
                Publicar Historia
            </button>

        </form>

    </div>
</div>

@endsection
