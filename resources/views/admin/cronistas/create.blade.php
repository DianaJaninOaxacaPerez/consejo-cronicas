@extends('admin.layout')
@section('title', 'Agregar Perfil')
@section('content')
<div class="section-title text-center mb-4">
  <h2>Agregar Perfil</h2>
</div>
<form action="{{ route('admin.cronistas.store') }}" method="POST" enctype="multipart/form-data" style="max-width:600px;margin:0 auto;">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nombre(s)</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Apellido paterno</label>
    <input type="text" name="paterno" class="form-control" value="{{ old('paterno') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Apellido materno</label>
    <input type="text" name="materno" class="form-control" value="{{ old('materno') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Cargo</label>
    <input type="text" name="cargo" class="form-control" value="{{ old('cargo') }}" placeholder="Ej. Presidente" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Biografía</label>
    <textarea name="biografia" class="form-control" rows="5" required>{{ old('biografia') }}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Correo</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Foto</label>
    <input type="file" name="foto" class="form-control" accept="image/*">
  </div>
  <button type="submit" class="btn-admin">Guardar</button>
</form>
@endsection