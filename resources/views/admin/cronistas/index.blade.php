@extends('admin.layout')
@section('title', 'Perfiles')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
@endpush
@section('content')
<div class="section-title text-center mb-4">
  <h2>Perfiles</h2>
  <p>Administra a los integrantes del consejo</p>
</div>
<div class="feed-container">
  @forelse($cronistas as $cronista)
    <div class="feed-card">
      <div class="feed-image">
        <img src="{{ $cronista->foto ? Storage::url($cronista->foto) : 'https://via.placeholder.com/300x300?text=Sin+foto' }}" alt="{{ $cronista->nombre }}">
      </div>
      <div class="feed-info">
        <span class="tag tag-evento">{{ $cronista->cargo }}</span>
        <h3>{{ $cronista->nombre_completo }}</h3>
        <div class="feed-actions">
          <a href="{{ route('admin.cronistas.edit', $cronista) }}" class="btn-editar">Editar</a>
          <form action="{{ route('admin.cronistas.destroy', $cronista) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres borrar este perfil?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-borrar" style="border:none;cursor:pointer;">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding:20px;">Aún no hay perfiles registrados.</p>
  @endforelse
  <div class="card admin-card">
    <div class="card-content">
      <h3>Agregar Perfil</h3>
      <p>Administre los perfiles del consejo.</p>
      <a href="{{ route('admin.cronistas.create') }}" class="btn-admin">Agregar</a>
    </div>
  </div>
</div>
@endsection