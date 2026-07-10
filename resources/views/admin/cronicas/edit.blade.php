@extends('admin.layout')

@section('title', 'Editar crónica')

@section('content')

<div class="admin-card">
  <form action="{{ route('admin.cronicas.update', $cronica) }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Título</label>
      <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $cronica->titulo) }}" required>
    </div>

    <div class="mb-3">
      <label>Autor</label>
      <input type="text" name="autor" class="form-control" value="{{ old('autor', $cronica->autor) }}" required>
    </div>

    <div class="mb-3">
      <label>Fecha</label>
      <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $cronica->fecha?->format('Y-m-d')) }}">
    </div>

    <div class="mb-3">
      <label>Resumen</label>
      <textarea name="resumen" rows="2" class="form-control">{{ old('resumen', $cronica->resumen) }}</textarea>
    </div>

    <div class="mb-3">
      <label>Contenido</label>
      <textarea name="contenido" rows="8" class="form-control">{{ old('contenido', $cronica->contenido) }}</textarea>
    </div>

    <div class="mb-3">
      <label>Imagen actual</label><br>
      @if($cronica->imagen)
        <img src="{{ Storage::url($cronica->imagen) }}" class="thumb mb-2" alt="{{ $cronica->titulo }}">
      @else
        <p style="color:#aaa;font-size:.85rem;">Sin imagen</p>
      @endif
      <input type="file" name="imagen" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn-admin btn-admin-primary">Actualizar crónica</button>
    <a href="{{ route('admin.cronicas.index') }}" class="btn-admin btn-admin-outline">Cancelar</a>
  </form>
</div>

@endsection