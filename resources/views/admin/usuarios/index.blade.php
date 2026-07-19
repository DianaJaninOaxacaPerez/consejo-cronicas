@extends('admin.layout')
@section('title', 'Usuarios')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
@endpush
@section('content')
<div class="admin-header">

    <div class="section-title text-center">
        <h2>Usuarios</h2>
        <p>Administra las cuentas de acceso al panel</p>
    </div>

    <a href="{{ route('admin.usuarios.create') }}"
       class="admin-add-btn">

        <span>＋</span>
        Agregar usuario

    </a>

</div>

@if(session('success'))
  <div class="alert-success" style="text-align:center; margin-bottom:20px;">
    {{ session('success') }}
  </div>
@endif

<div class="feed-container">
  @forelse($usuarios as $usuario)
    <div class="feed-card">
      <div class="feed-info">
        <span class="tag tag-evento">{{ $usuario->rol->nombre_rol ?? 'Sin rol' }}</span>
        <h3>{{ $usuario->nombre }}</h3>
        <p>{{ $usuario->correo }}</p>
        <p>Cargo: {{ $usuario->cargo }}</p>

        <p>Estado:
            <strong class="{{ $usuario->estado === 'activo' ? 'estado-activo' : 'estado-inactivo' }}">
            {{ ucfirst($usuario->estado) }}
            </strong>
        </p>

        <div class="feed-actions">
          <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn-editar">Editar</a>
          <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres desactivar este usuario?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-borrar" style="border:none;cursor:pointer;">Desactivar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding:20px;">Aún no hay usuarios registrados.</p>
  @endforelse

</div>
@endsection