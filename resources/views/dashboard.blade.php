@extends('admin.layout')
@section('title', 'Panel administrativo')
@section('content')
<h2 style="margin-bottom: 6px;">¿Qué desea visitar hoy?</h2>
<p style="color: var(--a-color2); margin-bottom: 24px;">Bienvenido(a), {{ auth()->user()->name }}</p>

<div class="dashboard-cards">
    <a href="{{ route('admin.historias.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/historia.svg') }}" alt="Historia"></div>
        <h3><i class="fa-solid fa-landmark"></i> Historia</h3>
        <p>Consulta y actualiza la información.</p>
    </a>

    <a href="{{ route('admin.cronicas.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/cronicas.svg') }}" alt="Crónicas"></div>
        <h3><i class="fa-solid fa-scroll"></i> Crónicas</h3>
        <p>Consulta y agrega.</p>
    </a>

    <a href="{{ route('admin.galeria.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/galeria.svg') }}" alt="Galería"></div>
        <h3><i class="fa-solid fa-images"></i> Galería</h3>
        <p>Administra imágenes y fotografías.</p>
    </a>

    <a href="{{ route('admin.eventos.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/eventos.svg') }}" alt="Eventos"></div>
        <h3><i class="fa-solid fa-calendar-days"></i> Eventos</h3>
        <p>Agrega eventos importantes.</p>
    </a>

    <a href="{{ route('admin.noticias.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/noticias.svg') }}" alt="Noticias"></div>
        <h3><i class="fa-solid fa-newspaper"></i> Noticias</h3>
        <p>Publica noticias y comunicados.</p>
    </a>

    <a href="{{ route('admin.entrevistas.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/entrevistas.svg') }}" alt="Entrevistas"></div>
        <h3><i class="fa-solid fa-microphone-lines"></i> Entrevistas</h3>
        <p>Agrega contenido interesante.</p>
    </a>

    <a href="{{ route('admin.cronistas.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/perfiles.svg') }}" alt="Perfiles"></div>
        <h3><i class="fa-solid fa-users"></i> Perfiles</h3>
        <p>Gestiona al equipo del consejo.</p>
    </a>
    <a href="{{ route('admin.usuarios.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/usuarios.svg') }}" alt="Usuarios"></div>
        <h3><i class="fa-solid fa-user-shield"></i> Usuarios</h3>
        <p>Administra las cuentas de acceso al panel.</p>
    </a>
    <a href="{{ route('admin.videos.index') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/videos.svg') }}" alt="Videos"></div>
        <h3><i class="fa-solid fa-video"></i> Videos</h3>
        <p>Sube videos y enlaces de redes sociales.</p>
    </a>

    <a href="{{ route('admin.configuracion.edit') }}" class="dashboard-card">
        <div class="dashboard-card-img"><img src="{{ asset('img/dashboard/configuracion.svg') }}" alt="Configuración"></div>
        <h3><i class="fa-solid fa-gear"></i> Editar logo y datos</h3>
        <p>Edita el logo y los datos de la página.</p>
    </a>



</div>
@endsection
@push('styles')
<style>
.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 22px;
}
.dashboard-card {
    display: block;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 3px 14px rgba(28,39,48,.08);
    border: 1px solid #EAF3FA;
    transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease;
}
.dashboard-card:hover {
    box-shadow: 0 10px 26px rgba(28,39,48,.14);
    transform: translateY(-4px);
    border-color: var(--a-color3);
}
.dashboard-card-img {
    background: linear-gradient(160deg, var(--a-color4), #fff);
    height: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px;
    overflow: hidden;
}
.dashboard-card-img img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    transition: transform .35s ease;
}
.dashboard-card:hover .dashboard-card-img img {
    transform: scale(1.12);
}
.dashboard-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    margin: 16px 18px 6px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color .2s ease;
}
.dashboard-card h3 i {
    color: var(--a-color3);
    font-size: 1rem;
    transition: color .2s ease;
}
.dashboard-card:hover h3 {
    color: var(--a-color3);
}
.dashboard-card:hover h3 i {
    color: var(--a-color2);
}
.dashboard-card p {
    margin: 0 18px 18px;
    color: #5C6B75;
    font-size: .9rem;
}
</style>
@endpush