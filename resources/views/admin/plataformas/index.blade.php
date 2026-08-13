@extends('admin.layout')

@section('title', 'Plataformas (Admin)')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/galeriaadmin.css') }}">
  <style>
    .acciones-galeria {
      display: flex; gap: 8px; margin-top: 10px; margin-bottom: 20px;
      justify-content: center; width: 100%;
    }
    .btn-pill {
      display: inline-flex; align-items: center; justify-content: center;
      padding: 6px 18px; border-radius: 50px; font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 700; text-decoration: none;
      border: 1px solid #CFE9FB; cursor: pointer; transition: all .25s ease;
      white-space: nowrap; width: auto; background: none;
    }
    .btn-editar-galeria, .btn-borrar-galeria { background-color: #E3F1FA; color: #33404A; }
    .btn-editar-galeria:hover, .btn-borrar-galeria:hover {
      background-color: #6FB8E0; color: #FFFFFF; border-color: #6FB8E0;
      transform: translateY(-2px); box-shadow: 0 6px 14px rgba(47,155,216,.28);
    }
    .encabezado-galeria-admin { position: relative; margin-bottom: 25px; padding: 0 190px; min-height: 75px; }
    .btn-agregar-galeria {
      position: absolute; top: 5px; right: 0; display: inline-flex; align-items: center;
      justify-content: center; gap: 7px; padding: 10px 22px; border-radius: 50px;
      background-color: #6FB8E0; color: #FFFFFF; border: 1px solid #6FB8E0;
      font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700;
      text-decoration: none; transition: all .25s ease; box-shadow: 0 4px 12px rgba(47,155,216,.25);
    }
    .btn-agregar-galeria:hover {
      background-color: #2F9BD8; border-color: #2F9BD8; color: #FFFFFF;
      transform: translateY(-2px); box-shadow: 0 7px 16px rgba(47,155,216,.35);
    }
    .plataforma-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
    }
    .plataforma-card {
      background: #fff; border-radius: 14px; overflow: hidden;
      box-shadow: 0 3px 14px rgba(28,39,48,.08); border: 1px solid #EAF3FA;
      display: flex; flex-direction: column; text-align: center;
    }
    .plataforma-card-media {
      height: 160px; background: #F7FBFE; display: flex; align-items: center;
      justify-content: center;
    }
    .plataforma-card-media img {
      width: 110px; height: 110px; border-radius: 50%; object-fit: cover;
    }
    .plataforma-card-body { padding: 14px 16px; flex: 1; display: flex; flex-direction: column; }
    .plataforma-card-body h3 { font-family: 'Playfair Display', serif; font-size: 1.05rem; margin: 0 0 10px; }
    .plataforma-links { display: flex; justify-content: center; gap: 10px; margin-bottom: 10px; }
    .plataforma-links a {
      display: inline-flex; align-items: center; justify-content: center;
      width: 34px; height: 34px; border-radius: 50%; color: #fff; font-size: .9rem;
    }
    .link-youtube { background: #ff0000; }
    .link-facebook { background: #1877f2; }
    .sin-enlace { color: #B7C4CC; font-size: .8rem; }

    .filtros-videos {
      background: #F7FBFE;
      border: 1px solid #EAF3FA;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 30px;
    }
    .filtros-videos .form-label {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: .82rem;
      color: #33404A;
      margin-bottom: 6px;
    }
    .filtros-videos .form-control {
      border-radius: 10px;
      border: 1px solid #CFE9FB;
      padding: 10px 14px;
      font-size: .9rem;
    }
    .filtros-videos .form-control:focus {
      border-color: #2F9BD8;
      box-shadow: 0 0 0 .15rem rgba(47,155,216,.15);
    }
    .buscador-clave { position: relative; }
    .buscador-clave i {
      position: absolute; left: 14px; top: 50%;
      transform: translateY(-50%); color: #8FA6B3;
    }
    .buscador-clave input { padding-left: 40px; }

    .btn-filtrar {
      background-color: #2F9BD8;
      border: none;
      color: #fff;
      font-weight: 700;
      border-radius: 10px;
      padding: 10px 24px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all .2s ease;
      height: 44px;
    }
    .btn-filtrar:hover { background-color: #1565C0; color: #fff; }

    @media (max-width: 768px) {
      .encabezado-galeria-admin { padding: 0; display: flex; flex-direction: column; align-items: center; gap: 15px; }
      .btn-agregar-galeria { position: static; }
    }
  </style>
@endpush

@section('content')

<div class="encabezado-galeria-admin">
  <div class="section-title text-center">
    <h2>Plataformas</h2>
    <p>Cronistas y sus redes</p>
  </div>
</div>

@if(session('success'))
  <div class="alert-success" style="text-align:center; margin-bottom:20px;">
    {{ session('success') }}
  </div>
@endif

{{-- 🔍 Barra de filtros --}}
<form method="GET" action="{{ route('admin.plataformas.index') }}" class="filtros-videos">
  <div class="row g-3 align-items-end">
    <div class="col-lg-10 col-md-9">
      <label class="form-label">&nbsp;</label>
      <div class="buscador-clave">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" class="form-control" placeholder="Buscar por nombre..." value="{{ request('q') }}">
      </div>
    </div>
    <div class="col-lg-2 col-md-3">
      <button type="submit" class="btn-filtrar w-100">
        <i class="fa-solid fa-filter"></i> Filtrar
      </button>
    </div>
  </div>
</form>

<div class="plataforma-grid">
    @forelse($cronistas as $cronista)
    <div class="plataforma-card">
      <div class="plataforma-card-media">
        <img
          src="{{ $cronista->foto ? Storage::url($cronista->foto) : asset('img/default-perfil.png') }}"
          alt="{{ $cronista->nombre_completo }}"
        >
      </div>
      <div class="plataforma-card-body">
        <h3>{{ $cronista->nombre_completo }}</h3>
        <div class="plataforma-links">
          @if($cronista->youtube)
            <a href="{{ $cronista->youtube }}" target="_blank" rel="noopener noreferrer" class="link-youtube" title="YouTube" >
              <i class="fa-brands fa-youtube"></i>
            </a>
          @endif
          @if($cronista->facebook)
            <a href="{{ $cronista->facebook }}"  target="_blank"  rel="noopener noreferrer" class="link-facebook" title="Facebook">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
          @endif
          @if(!$cronista->youtube && !$cronista->facebook)
            <span class="sin-enlace">Sin enlaces registrados</span>
          @endif
        </div>

        <div class="acciones-galeria">
          <a href="{{ route('admin.plataformas.edit', $plataforma) }}" class="btn-pill btn-editar-galeria">Editar</a>
          <form action="{{ route('admin.plataformas.destroy', $plataforma) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta plataforma?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-pill btn-borrar-galeria">Borrar</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p style="padding:20px; text-align:center;">Aún no hay plataformas registradas.</p>
  @endforelse
</div>

@endsection