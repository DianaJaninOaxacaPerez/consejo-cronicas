<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Voces y crónicas Huejutlenses')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/inicio.css') }}?v=4">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  @stack('styles')
</head>

<body>

  <!-- Barra superior solo en móvil/tablet -->
  <div class="mobile-topbar d-lg-none">
    <a href="{{ route('inicio') }}">
      <img src="{{ asset('img/' . $config->logo) }}" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <div class="offcanvas-lg offcanvas-start sidebar" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">

    <div class="offcanvas-header d-lg-none">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Menú</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Cerrar"></button>
    </div>

    <div class="offcanvas-body sidebar-body d-flex flex-column">

      <a class="logo d-none d-lg-block mb-4" href="{{ route('inicio') }}">
        <img src="{{ asset('img/' . $config->logo) }}" alt="Logo">
      </a>

      <ul class="menu nav flex-column">
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('inicio') }}">
            <i class="fa-solid fa-house"></i> Inicio
          </a>
        </li>
        <li class="nav-item">
           <a class="nav-link opcion-menu-buscable" href="{{ route('historia') }}">
            <i class="fa-solid fa-landmark"></i> Historia
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('cronicas') }}">
            <i class="fa-solid fa-scroll"></i> Crónicas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('galeria') }}">
            <i class="fa-solid fa-images"></i> Galería
          </a>
        </li>
        <li class="nav-item">
           <a class="nav-link opcion-menu-buscable" href="{{ route('eventos') }}">
            <i class="fa-solid fa-calendar-days"></i> Eventos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('noticias') }}">
            <i class="fa-solid fa-newspaper"></i> Noticias
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('entrevistas') }}">
            <i class="fa-solid fa-microphone-lines"></i> Entrevistas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('perfiles') }}">
          <i class="fa-solid fa-users"></i> Perfiles
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion-menu-buscable" href="{{ route('videos') }}">
          <i class="fa-solid fa-video"></i> Videos
          </a>
        </li>
      </ul>

    </div>
  </div>

  <div class="main-content">
    @yield('content')
  </div>

  @include('layouts.public-footer')

  <script src="{{ asset('js/inicio.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/buscador.js') }}"></script>

  @stack('scripts')

</body>
</html>