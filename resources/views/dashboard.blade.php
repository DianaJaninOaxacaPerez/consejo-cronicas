@extends('admin.layout')

@section('title', 'Panel administrativo')

@section('content')
<h2 style="margin-bottom: 6px;">¿Qué desea visitar hoy?</h2>
<p style="color: var(--a-color2); margin-bottom: 24px;">Bienvenido(a), {{ auth()->user()->name }}</p>

<div class="dashboard-cards">
    <a href="{{ route('admin.historias.index') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-landmark"></i> Historia</h3>
        <p>Consulta y actualiza la información.</p>
    </a>

    <a href="{{ route('admin.cronicas.index') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-scroll"></i> Crónicas</h3>
        <p>Consulta y agrega.</p>
    </a>

    <a href="{{ route('admin.galeria.index') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-images"></i> Galería</h3>
        <p>Administra imágenes y fotografías.</p>
    </a>

    <a href="{{ route('admin.eventos.index') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-calendar-days"></i> Eventos</h3>
        <p>Agrega eventos importantes.</p>
    </a>

    <a href="{{ route('admin.noticias.index') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-newspaper"></i> Noticias</h3>
        <p>Publica noticias y comunicados.</p>
    </a>

    <a href="{{ route('admin.entrevistas.index') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-microphone-lines"></i> Entrevistas</h3>
        <p>Agrega contenido interesante.</p>
    </a>

    <a href="{{ route('admin.configuracion.edit') }}" class="dashboard-card">
        <h3><i class="fa-solid fa-gear"></i> Editar logo y datos</h3>
        <p>Edita el logo y los datos de la página.</p>
    </a>
</div>
@endsection

@push('styles')
<style>
.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}
.dashboard-card {
    display: block;
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    border: 1px solid transparent;
    transition: box-shadow .15s ease, transform .15s ease, border-color .15s ease;
}
.dashboard-card:hover {
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    transform: translateY(-2px);
    border-color: #cfe2ff;
}
.dashboard-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    margin-bottom: 8px;
}
.dashboard-card p {
    margin: 0;
    color: #555;
    font-size: .92rem;
}
</style>
@endpush