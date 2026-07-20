<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Registro confirmado!</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-body">
    <div class="login-container" style="text-align:center;">
        <div style="font-size:3rem; color:#28a745; margin-bottom:10px;">✓</div>
        <h2>¡Registro confirmado!</h2>
        <p>Gracias por confirmar tu asistencia, <strong>{{ $registro->nombre }}</strong>.</p>
        <p>Tu mesa de trabajo asignada es:</p>
        <p style="font-size:1.3rem; font-weight:700; color:#1565C0;">{{ $registro->mesa->nombre }}</p>
        <p style="margin-top:20px; font-size:.9rem; color:#666;">Coloquio de la Crónica de Huejutla · 15 de agosto</p>
    </div>
</body>
</html>