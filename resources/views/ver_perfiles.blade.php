@extends('layouts.modulo')
@section('title', $cronista->nombre_completo . ' - Consejo Huejutlense de la Crónica')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush
@section('content')
<section class="container py-5" style="max-width: 700px;">
  <div class="text-center mb-4">
    <img src="{{ $cronista->foto ? Storage::url($cronista->foto) : asset('img/default-perfil.png') }}"
         alt="{{ $cronista->nombre }}"
         style="width:200px;height:200px;border-radius:50%;object-fit:cover;border:4px solid #cfe2ff;">
    <h2 class="mt-3">{{ $cronista->nombre_completo }}</h2>
    <p class="text-muted">{{ $cronista->cargo }}</p>
  </div>
  <div>
    <h3 class="h5">Biografía</h3>
    <p>{{ $cronista->biografia }}</p>
  </div>
  <div class="text-center mt-4">
    <a href="{{ route('perfiles') }}" class="btn-editar">← Regresar a Perfiles</a>
  </div>
</section>
@endsection