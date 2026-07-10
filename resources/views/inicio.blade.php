@extends('layouts.public')

@section('title', 'Inicio - Voces y crónicas Huejutlenses')

@section('content')

<header class="hero-header">
<div class="hero" id="inicio">
  <div class="hero-content">
    <h1>VOCES Y CRONICAS HUEJUTLENSES</h1>
  </div>
</div>
</header>

<section id="historia">
  <div class="section-title">
    <p>Conociendo nuestras raíces</p>
  </div>

  <div class="cards">
  <div class="card">
  <div class="card-img-wrap">
    <img src="{{ asset('img/danzas.jpeg') }}" alt="Misión">
  </div>
  <div class="card-content">
        <h3>Misión</h3>
        <p>
          Preservar, investigar y difundir la historia, tradiciones y patrimonio cultural
          del municipio, a través de la producción de crónicas, investigaciones y actividades
          que fortalezcan la identidad local y promuevan el conocimiento histórico entre la ciudadanía.
        </p>
      </div>
    </div>
    <div class="card">
      <div class="card-img-wrap">
      <img src="{{ asset('img/reloj.webp') }}" alt="Visión">
      </div>
      <div class="card-content">
        <h3>Visión</h3>
        <p>
          Ser un referente en la construcción de la memoria histórica del municipio,
          reconocido por su compromiso con la cultura, la educación y la participación
          comunitaria, contribuyendo al fortalecimiento de la identidad y el patrimonio cultural.
        </p>
      </div>
    </div>

    <div class="card">
      <div class="card-img-wrap">
      <img src="{{ asset('img/Huejutla, Hidalgo.jpg') }}" alt="Propósito">
        </div>
      <div class="card-content">
        <h3>Propósito</h3>
        <p>
          Promover la conservación, investigación, documentación y difusión de la historia,
          cultura, tradiciones y patrimonio de Huejutla de Reyes, fortaleciendo el sentido
          de pertenencia e identidad de la comunidad.
        </p>
      </div>
    </div>

    <div class="card">
      <div class="card-img-wrap">
      <img src="https://images.unsplash.com/photo-1516307365426-bea591f05011?q=80&w=1200&auto=format&fit=crop" alt="Identidad">
        </div>
      <div class="card-content">
        <h3>Nuestra Identidad</h3>
        <p>
          La identidad gráfica del Consejo Huejutlense de la Crónica representa la historia,
          la cultura y la memoria colectiva de Huejutla de Reyes, Hidalgo. El sauce representa
          las raíces y la conexión con el territorio; el reloj municipal simboliza el paso del
          tiempo; y el caracol estilizado representa la comunicación y la transmisión del
          conocimiento entre generaciones.
        </p>
      </div>
    </div>
  </div>
</section>

@endsection


@section('footer-franja')
  <div class="footer-franja"></div>
@endsection