@extends('admin.layout')

@section('title', 'Crónicas')

@section('content')

<div class="admin-card">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <span style="font-size:.9rem;color:var(--a-color2);">{{ $cronicas->total() }} crónica(s) registrada(s)</span>
    <a href="{{ route('admin.cronicas.create') }}" class="btn-admin btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Nueva crónica
    </a>
  </div>

  <table class="admin-table">
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($cronicas as $cronica)
        <tr>
          <td>
            @if($cronica->imagen)
              <img src="{{ Storage::url($cronica->imagen) }}" class="thumb" alt="{{ $cronica->titulo }}">
            @else
              <span style="color:#aaa;font-size:.8rem;">Sin imagen</span>
            @endif
          </td>
          <td>{{ $cronica->titulo }}</td>
          <td>{{ $cronica->autor }}</td>
          <td>{{ $cronica->fecha ? $cronica->fecha->format('d/m/Y') : '—' }}</td>
          <td>
            <a href="{{ route('admin.cronicas.edit', $cronica) }}" class="btn-admin btn-admin-outline">Editar</a>
            <form action="{{ route('admin.cronicas.destroy', $cronica) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres eliminar esta crónica?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-admin btn-admin-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center py-4">No hay crónicas registradas aún.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $cronicas->links() }}
  </div>

</div>

@endsection