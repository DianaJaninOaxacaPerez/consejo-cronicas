@extends('admin.layout')
@section('title', 'Mesas de Trabajo')
@section('content')

<div class="section-title text-center">
    <h2>Mesas de Trabajo</h2>
    <p>Edita los nombres de las mesas del coloquio</p>
</div>

@if(session('success'))
  <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
@endif

<div style="max-width:600px; margin:0 auto;">
@foreach($mesas as $mesa)
    <form action="{{ route('admin.mesas.update', $mesa) }}" method="POST" style="display:flex; gap:10px; margin-bottom:12px; align-items:center;">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ $mesa->nombre }}" style="flex:1; padding:10px; border-radius:8px; border:1px solid #ccc;">
        <button type="submit" class="admin-add-btn" style="padding:10px 18px;">Guardar</button>
    </form>
@endforeach
</div>

@endsection