@extends('admin.layout')

@section('title', 'Editar Historia')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/subir.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="upload-container">

    <a href="{{ route('admin.historias.index') }}" class="btn-volver-fixed">
        ← Volver
    </a>

    <div class="upload-card">

        <h1>Editar Historia</h1>
        <p>Actualiza los datos de esta historia.</p>

        <form method="POST" action="{{ route('admin.historias.update', $historia) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label>Título de la historia</label>
                <input type="text" name="titulo" required value="{{ old('titulo', $historia->titulo) }}">
            </div>

            <div class="input-group">
                <label>Descripción corta</label>
                <input type="text" name="descripcion" required value="{{ old('descripcion', $historia->descripcion) }}">
            </div>

            <div class="input-group">
                <label>Categoría</label>
                <select name="categoria" required>
                    @foreach($categorias as $valor => $etiqueta)
                        <option value="{{ $valor }}" {{ old('categoria', $historia->categoria) === $valor ? 'selected' : '' }}>
                            {{ $etiqueta }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label>Autor</label>
                <input type="text" name="autor" placeholder="Nombre del cronista o autor" value="{{ old('autor', $historia->autor) }}">
            </div>

            @if($historia->imagen)
                <div class="input-group">
                    <label>Imagen actual</label>
                    <img src="{{ Storage::url($historia->imagen) }}" alt="{{ $historia->titulo }}" style="width:160px;border-radius:10px;display:block;margin-bottom:10px;">
                </div>
            @endif

            <div class="input-group">
                <label>Reemplazar fotografía (opcional)</label>
                <input type="file" name="imagen" accept="image/*">
            </div>

            <button type="submit" class="btn-upload">
                Guardar cambios
            </button>

        </form>

    </div>
</div>

@endsection