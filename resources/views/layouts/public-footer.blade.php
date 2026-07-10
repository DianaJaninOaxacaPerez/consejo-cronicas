<footer class="footer-global">

    @hasSection('footer-franja')
        @yield('footer-franja')
    @endif

    <div class="footer-content">

        <div class="footer-logo-box">
            <img src="{{ asset('img/' . $config->logo) }}" class="footer-logo" alt="Logo">
        </div>

        <h2>Crónica Huejutlense</h2>

        <p class="footer-slogan">
            Preservando la historia, cultura y memoria colectiva de Huejutla de Reyes.
        </p>

        <div class="footer-redes">
            <a href="{{ $config->facebook ?: '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
            <a href="{{ $config->instagram ?: '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
            <a href="{{ $config->tiktok ?: '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-tiktok"></i></a>
            <a href="{{ $config->youtube ?: '#' }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
        </div>

        <div class="footer-contact">
            <p><strong>Correo:</strong> {{ $config->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $config->telefono }}</p>
            <p><strong>Ubicación:</strong> {{ $config->ubicacion }}</p>
        </div>

        <div class="footer-copy">
            © 2026 Crónica Huejutlense | Todos los derechos reservados.
        </div>

    </div>

</footer>