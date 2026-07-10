@extends('admin.layout')

@section('title', 'Nueva crónica')

@section('content')

<div class="admin-card">
  <form action="{{ route('admin.cronicas.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf

    <div class="mb-3">
      <label>Título</label>
      <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
    </div>

    <div class="mb-3">
      <label>Autor</label>
      <input type="text" name="autor" class="form-control" value="{{ old('autor') }}" required>
    </div>

    <div class="mb-3">
      <label>Fecha</label>
      <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
    </div>

    <div class="mb-3">
      <label>Resumen</label>
      <textarea name="resumen" rows="2" class="form-control">{{ old('resumen') }}</textarea>
    </div>

    <div class="mb-3">
      <label>Contenido</label>
      <textarea name="contenido" rows="8" class="form-control">{{ old('contenido') }}</textarea>
    </div>

    <div class="mb-4">
      <label>Imagen</label>
      <input type="file" name="imagen" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn-admin btn-admin-primary">Guardar crónica</button>
    <a href="{{ route('admin.cronicas.index') }}" class="btn-admin btn-admin-outline">Cancelar</a>
  </form>
</div>

@endsection