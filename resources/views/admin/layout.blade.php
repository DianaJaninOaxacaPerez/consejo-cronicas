<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Panel administrativo') - Crónica Huejutlense</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  @stack('styles')
</head>
<body>

  <aside class="admin-sidebar">
    <div class="logo">
      <img src="{{ asset('img/' . $config->logo) }}" alt="Logo">
    </div>

    <ul class="admin-menu">
      <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
      <li><a href="{{ route('admin.cronicas.index') }}" class="{{ request()->routeIs('admin.cronicas.*') ? 'active' : '' }}"><i class="fa-solid fa-scroll"></i> Crónicas</a></li>
      <li><a href="{{ route('admin.historias.index') }}" class="{{ request()->routeIs('admin.historias.*') ? 'active' : '' }}"><i class="fa-solid fa-landmark"></i> Historias</a></li>
      <li><a href="{{ route('admin.galeria.index') }}" class="{{ request()->routeIs('admin.galeria.*') ? 'active' : '' }}"><i class="fa-solid fa-images"></i> Galería</a></li>
      <li><a href="{{ route('admin.eventos.index') }}" class="{{ request()->routeIs('admin.eventos.*') ? 'active' : '' }}"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>
      <li><a href="{{ route('admin.noticias.index') }}" class="{{ request()->routeIs('admin.noticias.*') ? 'active' : '' }}"><i class="fa-solid fa-newspaper"></i> Noticias</a></li>
      <li><a href="{{ route('admin.entrevistas.index') }}" class="{{ request()->routeIs('admin.entrevistas.*') ? 'active' : '' }}"><i class="fa-solid fa-microphone-lines"></i> Entrevistas</a></li>
      <li><a href="{{ route('admin.configuracion.edit') }}" class="{{ request()->routeIs('admin.configuracion.*') ? 'active' : '' }}"><i class="fa-solid fa-gear"></i> Configuración</a></li>
    </ul>

    <form method="POST" action="{{ route('logout') }}" class="logout-form">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
      </button>
    </form>
  </aside>

  <div class="admin-content">

    <div class="admin-topbar">
      <h1>@yield('title', 'Panel administrativo')</h1>
      <span style="font-size:.85rem;color:var(--a-color2);">
        {{ auth()->user()->name }}
      </span>
    </div>

    @if(session('success'))
      <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="admin-alert admin-alert-error">
        <ul style="margin:0;padding-left:18px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>