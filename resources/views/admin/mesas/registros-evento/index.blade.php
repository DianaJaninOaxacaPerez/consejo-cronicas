@extends('admin.layout')
@section('title', 'Registros del Evento')
@section('content')

<div class="section-title text-center">
    <h2>Confirmaciones de Asistencia</h2>
    <p>Coloquio de la Crónica - 15 de agosto</p>
</div>

<div style="text-align:center; margin-bottom:30px;">
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($urlPublica) }}" alt="Código QR de registro">
    <p style="font-size:.85rem; color:#666; margin-top:8px;">Escanea o imprime este código para que los asistentes se registren</p>
    <p style="font-size:.8rem; color:#999;">{{ $urlPublica }}</p>
</div>

<p style="text-align:center; font-weight:600;">Total de registros: {{ $registros->count() }}</p>

<table style="width:100%; border-collapse:collapse; margin-top:20px;">
    <thead>
        <tr style="background:#E3F1FA; text-align:left;">
            <th style="padding:10px;">Nombre</th>
            <th style="padding:10px;">Teléfono</th>
            <th style="padding:10px;">Mesa</th>
            <th style="padding:10px;">Fecha</th>
            <th style="padding:10px;"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($registros as $registro)
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:10px;">{{ $registro->nombre }}</td>
                <td style="padding:10px;">{{ $registro->telefono }}</td>
                <td style="padding:10px;">{{ $registro->mesa->nombre ?? 'N/A' }}</td>
                <td style="padding:10px;">{{ \Carbon\Carbon::parse($registro->fecha_registro)->format('d/m/Y H:i') }}</td>
                <td style="padding:10px;">
                    <form action="{{ route('admin.registros-evento.destroy', $registro) }}" method="POST" onsubmit="return confirm('¿Eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-borrar" style="border:none; background:none; color:#d9534f; cursor:pointer;">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" style="padding:20px; text-align:center;">Aún no hay registros.</td></tr>
        @endforelse
    </tbody>
</table>

@endsection