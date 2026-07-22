<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar asistencia - Coloquio de la Crónica</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-body">
    <div class="login-container">

        <img src="{{ asset('img/LogoConsejo-removebg-preview.png') }}" alt="Logo" class="login-logo">

        @if($abierto)

            <h2>Confirma tu asistencia</h2>
            <p>Coloquio de la Crónica de Huejutla - 15 de agosto</p>

            @if(session('error'))
                <div style="color:#ff3333; background:#ffe6e6; border:1px solid #ffb3b3; padding:10px; border-radius:5px; margin-bottom:15px; font-size:14px; text-align:center;">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div style="color:#ff3333; background:#ffe6e6; border:1px solid #ffb3b3; padding:10px; border-radius:5px; margin-bottom:15px; font-size:14px; text-align:center;">
                    @foreach($errors->all() as $error)
                        <p style="margin:0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('evento.confirmar.store') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value="{{ old('nombre') }}" required>
                </div>

                <div class="input-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" value="{{ old('telefono') }}" required>
                </div>

                <div class="input-group">
                    <label for="id_mesa">Mesa de trabajo a la que asistirás</label>
                    <select id="id_mesa" name="id_mesa" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
                        <option value="">Selecciona una mesa</option>
                        @foreach($mesas as $mesa)
                            <option value="{{ $mesa->id_mesa }}" {{ old('id_mesa') == $mesa->id_mesa ? 'selected' : '' }}>{{ $mesa->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-submit">Confirmar asistencia</button>
            </form>

        @else

            <div style="text-align:center; padding:20px 0;">
                <div style="font-size:2.5rem; color:#e69500; margin-bottom:10px;">⏰</div>
                <h2>Registro no disponible</h2>
                <p style="margin-top:10px;">
                    El registro de asistencia solo está abierto el <strong>15 de agosto</strong>,
                    de <strong>8:00 a.m. a 8:50 a.m.</strong>
                </p>
                <p style="margin-top:15px; color:#666; font-size:.9rem;">
                    Por favor regresa a esta página durante ese horario para confirmar tu asistencia.
                </p>
            </div>

        @endif

    </div>
</body>
</html>