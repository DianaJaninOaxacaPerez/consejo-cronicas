@extends('admin.layout')
@section('title', 'Editar usuario')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
@endpush
@section('content')

<div class="section-title text-center">
    <h2>Editar usuario</h2>
    <p>Actualiza los datos de la cuenta</p>
</div>

<form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" class="admin-form">
    @csrf
    @method('PUT')

    <label>Nombre completo</label>
    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
    @error('nombre') <p class="form-error">{{ $message }}</p> @enderror

    <label>Cargo</label>
    <input type="text" name="cargo" value="{{ old('cargo', $usuario->cargo) }}" required>
    @error('cargo') <p class="form-error">{{ $message }}</p> @enderror

    <label>Correo electrónico</label>
    <input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
    @error('correo') <p class="form-error">{{ $message }}</p> @enderror

    <label>Nueva contraseña <small>(déjalo en blanco para no cambiarla)</small></label>
    <div class="password-field">
        <input type="password" name="password" id="password">
        <i class="fa-solid fa-eye toggle-password" data-target="password"></i>
    </div>
    @error('password') <p class="form-error">{{ $message }}</p> @enderror

    <label>Confirmar nueva contraseña</label>
    <div class="password-field">
        <input type="password" name="password_confirmation" id="password_confirmation">
        <i class="fa-solid fa-eye toggle-password" data-target="password_confirmation"></i>
    </div>

    <label>Rol</label>
    <select name="id_rol" required>
        @foreach($roles as $rol)
            <option value="{{ $rol->id_rol }}" {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                {{ $rol->nombre_rol }}
            </option>
        @endforeach
    </select>
    @error('id_rol') <p class="form-error">{{ $message }}</p> @enderror

    <div class="feed-actions" style="margin-top:20px;">
        <button type="submit" class="admin-add-btn">Actualizar usuario</button>
        <a href="{{ route('admin.usuarios.index') }}" class="btn-editar">Cancelar</a>
    </div>
</form>

@push('scripts')
<script>
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});
</script>
@endpush

@endsection