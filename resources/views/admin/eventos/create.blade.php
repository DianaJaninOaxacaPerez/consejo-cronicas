@extends('admin.layout')

@section('title', 'Agregar Evento')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="upload-container">
  <a href="{{ route('admin.eventos.index') }}" class="btn-volver-fixed">← Volver</a>

  <div class="upload-card">
    <h1>Agregar Evento</h1>
    <p>Registra un nuevo evento o celebración cultural.</p>

    <form method="POST" action="{{ route('admin.eventos.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="input-group">
        <label>Nombre del Evento</label>
        <input type="text" name="nombre" required placeholder="Ej. Feria del Xantolo" value="{{ old('nombre') }}">
      </div>

      <div class="input-group">
        <label>Fecha</label>
        <input type="date" name="fecha" required value="{{ old('fecha') }}">
      </div>

      <div class="input-group">
        <label>Lugar</label>
        <input type="text" name="lugar" required placeholder="Ej. Plaza Principal" value="{{ old('lugar') }}">
      </div>

      <div class="input-group">
        <label>Descripción</label>
        <textarea name="descripcion" required rows="5">{{ old('descripcion') }}</textarea>
      </div>

      <div class="input-group">
        <label>Imagen del banner</label>
        <input type="file" name="imagen" accept="image/*" required>
      </div>

      <button type="submit" class="btn-upload">Publicar Evento</button>
    </form>
  </div>
</div>

@endsection