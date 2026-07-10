@extends('layouts.modulo')

@section('title', 'Historia - Voces y crónicas Huejutlenses')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('content')

<section id="historia" class="container py-5">


  <div class="section-title text-center mb-4">
    <h2>Historia de Huejutla</h2>
    <p>Conociendo nuestras raíces</p>
  </div>

  <div class="search-box mb-4 mx-auto" style="max-width: 400px;">
    <input type="text" id="inputBusqueda" class="form-control" placeholder="Buscar por título...">
  </div>

  <div class="cards row g-4">
    @forelse($historias as $historia)
      <div class="col-md-4">
        <div class="card h-100">
          <img src="{{ asset('img/' . $historia->imagen) }}" class="card-img-top" alt="{{ $historia->titulo }}">
          <div class="card-content card-body">
            <h3 class="h5">{{ $historia->titulo }}</h3>
            <p>{{ $historia->descripcion }}</p>
            <small>Publicado el {{ $historia->fecha_creacion->format('d/m/Y') }}</small>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center">No hay historias registradas aún.</p>
    @endforelse
  </div>

</section>

@endsection

@push('scripts')
  <script src="{{ asset('js/leercronica.js') }}"></script>
@endpush