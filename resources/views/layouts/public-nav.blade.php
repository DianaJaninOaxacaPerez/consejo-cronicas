<header>
  <nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container-fluid nav-inner">

      <a class="navbar-brand logo" href="{{ route('inicio') }}">
        <img src="{{ asset('img/' . $config->logo) }}" alt="Logo">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Abrir menú">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">

        <ul class="navbar-nav mx-auto text-center menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('historia') }}">Historia</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('cronicas') }}">Crónicas</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('galeria') }}">Galería</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('eventos') }}">Eventos</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('noticias') }}">Noticias</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('entrevistas') }}">Entrevistas</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('perfiles') }}">Perfiles</a></li>
        </ul>

        <div class="menu-title d-lg-none">CRÓNICA HUEJUTLENSE</div>

        <div class="nav-actions">
          <div class="search-box">
            <input type="text" id="inputBusqueda" placeholder="Buscar por título...">
          </div>

          <a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a>
        </div>

      </div>

    </div>
  </nav>
</header>