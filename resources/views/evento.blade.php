<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia - Coloquio de la Crónica</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-body">
    <div class="login-container" style="text-align:center;">
        <img src="{{ asset('img/LogoConsejo-removebg-preview.png') }}" alt="Logo" class="login-logo">

        <h2>Coloquio de la Crónica</h2>
        <p style="margin-bottom:20px;">15 de agosto</p>

        <img src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data={{ urlencode($urlPublica) }}"
             alt="Código QR de registro" style="max-width:100%; height:auto;">

        <p style="font-size:1.1rem; font-weight:600; margin-top:20px;">
            Escanea el código para registrar tu asistencia
        </p>
        <p style="font-size:.85rem; color:#666;">{{ $urlPublica }}</p>
    </div>
</body>
</html>