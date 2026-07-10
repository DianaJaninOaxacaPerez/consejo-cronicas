@extends('admin.layout')
@section('title', 'Agregar Entrevista')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@endpush
@section('content')
<div class="upload-container">
  <a href="{{ route('admin.entrevistas.index') }}" class="btn-volver-fixed">&larr; Volver</a>
  <div class="upload-card">
    <h1>Agregar Entrevista</h1>
    <p>Registra una nueva entrevista.</p>
    <form method="POST" action="{{ route('admin.entrevistas.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="input-group">
        <label>Título</label>
        <input type="text" name="titulo" required placeholder="Ej. Entrevista con el Cronista Municipal" value="{{ old('titulo') }}">
      </div>
      <div class="input-group">
        <label>Resumen</label>
        <textarea name="subtitulo" required rows="3" maxlength="200">{{ old('subtitulo') }}</textarea>
      </div>
      <div class="input-group">
        <label>Descripción</label>
        <textarea name="contenido" required rows="10">{{ old('contenido') }}</textarea>
      </div>
      <div class="input-group">
        <label>Imagen</label>
        <input type="file" name="imagen" accept="image/*" required>
      </div>
      <button type="submit" class="btn-upload">Publicar Entrevista</button>
    </form>
  </div>
</div>
@endsection