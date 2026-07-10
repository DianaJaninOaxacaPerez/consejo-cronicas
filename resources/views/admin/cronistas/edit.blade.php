@extends('admin.layout')
@section('title', 'Editar Perfil')
@section('content')
<div class="section-title text-center mb-4">
  <h2>Editar Perfil</h2>
</div>
<form action="{{ route('admin.cronistas.update', $cronista) }}" method="POST" enctype="multipart/form-data" style="max-width:600px;margin:0 auto;">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label class="form-label">Nombre(s)</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cronista->nombre) }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Apellido paterno</label>
    <input type="text" name="paterno" class="form-control" value="{{ old('paterno', $cronista->paterno) }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Apellido materno</label>
    <input type="text" name="materno" class="form-control" value="{{ old('materno', $cronista->materno) }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Cargo</label>
    <input type="text" name="cargo" class="form-control" value="{{ old('cargo', $cronista->cargo) }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Biografía</label>
    <textarea name="biografia" class="form-control" rows="5" required>{{ old('biografia', $cronista->biografia) }}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Correo</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo', $cronista->correo) }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $cronista->telefono) }}">
  </div>
  @if($cronista->foto)
    <div class="mb-3">
      <img src="{{ Storage::url($cronista->foto) }}" style="width:100px;height:100px;border-radius:50%;object-fit:cover;">
    </div>
  @endif
  <div class="mb-3">
    <label class="form-label">Cambiar foto</label>
    <input type="file" name="foto" class="form-control" accept="image/*">
  </div>
  <button type="submit" class="btn-admin">Actualizar</button>
</form>
@endsection