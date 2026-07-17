<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Voces y crónicas Huejutlenses')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link
  rel="stylesheet"
  href="{{ asset('css/inicio.css') }}?v={{ filemtime(public_path('css/inicio.css')) }}"
>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  @stack('styles')
</head>

<body>

  @include('layouts.public-nav')

  @yield('content')

  @include('layouts.public-footer')

  <script src="{{ asset('js/inicio.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/buscador.js') }}"></script>
  <script src="{{ asset('js/buscadorInicio.js') }}?v={{ filemtime(public_path('js/buscadorInicio.js')) }}"></script>

  @stack('scripts')

</body>
</html>