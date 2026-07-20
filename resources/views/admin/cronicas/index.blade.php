@extends('admin.layout')

@section('title', 'Crónicas')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<div class="admin-header">

  <div class="section-title text-center">
    <h2>Crónicas</h2>
    <p>Administra las crónicas registradas</p>
  </div>

  <a
    href="{{ route('admin.cronicas.create') }}"
    class="admin-add-btn"
  >
    <span>＋</span>
    Nueva crónica
  </a>

</div>

<form
  method="GET"
  action="{{ route('admin.cronicas.index') }}"
  class="filtros-cronicas"
>
  <span class="filtros-cronicas__label">
    Filtros
  </span>

  <input
    type="text"
    name="titulo"
    class="filtros-cronicas__input"
    placeholder="Título de la crónica"
    value="{{ request('titulo') }}"
  >

  <input
    type="text"
    name="autor"
    class="filtros-cronicas__input"
    placeholder="Autor"
    value="{{ request('autor') }}"
  >

  <input
    type="date"
    name="fecha"
    class="filtros-cronicas__input"
    value="{{ request('fecha') }}"
  >

  <button
    type="submit"
    class="filtros-cronicas__btn"
    title="Aplicar filtros"
  >
    +
  </button>

  @if(request()->anyFilled(['titulo', 'autor', 'fecha']))
    <a
      href="{{ route('admin.cronicas.index') }}"
      class="filtros-cronicas__limpiar"
    >
      Limpiar filtros
    </a>
  @endif
</form>

<p class="cronicas-total">
  {{ $cronicas->total() }} crónica(s) registrada(s)
</p>

<div class="cronicas-grid cronicas-grid-admin">

  @forelse($cronicas as $cronica)

    @php
      $imgDefault = asset('img/default-cronica.png');
    @endphp

    <article class="cronica-card cronica-card-admin">

      <div class="cronica-card__imagen-contenedor">
        <img
          src="{{ $cronica->imagen
              ? Storage::url($cronica->imagen)
              : $imgDefault }}"
          alt="{{ $cronica->titulo }}"
          class="cronica-card__imagen"
          onerror="this.onerror=null;this.src='{{ $imgDefault }}';"
        >
      </div>

      <div class="cronica-card__contenido">

        <span class="cronica-etiqueta">
          Crónica
        </span>

        <h3>{{ $cronica->titulo }}</h3>

        <h4>
          Por: {{ $cronica->autor }}
        </h4>

        <p class="cronica-card__resumen">
          {{ \Illuminate\Support\Str::limit($cronica->resumen, 220) }}
        </p>

        <small class="cronica-card__fecha">
          {{ $cronica->fecha
              ? $cronica->fecha->translatedFormat('d M Y')
              : 'Sin fecha' }}
        </small>

        <div class="cronica-admin-acciones">

          <a
            href="{{ route('admin.cronicas.edit', $cronica) }}"
            class="btn-admin-cronica btn-editar-cronica"
          >
            Editar
          </a>

          <form
            action="{{ route('admin.cronicas.destroy', $cronica) }}"
            method="POST"
            onsubmit="return confirm('¿Seguro que quieres eliminar esta crónica?');"
          >
            @csrf
            @method('DELETE')

            <button
              type="submit"
              class="btn-admin-cronica btn-eliminar-cronica"
            >
              Eliminar
            </button>
          </form>

        </div>

      </div>

    </article>

  @empty

    <p class="cronicas-vacio">
      No hay crónicas registradas aún.
    </p>

  @endforelse

</div>

<div class="mt-4">
  {{ $cronicas->links() }}
</div>

@endsection