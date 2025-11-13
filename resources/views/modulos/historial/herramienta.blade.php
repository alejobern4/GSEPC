@extends('layouts.modulos')

@section('content')
<div class="container">
    <h1>Hoja de Vida de la Herramienta</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $herramienta->nombre ?? $herramienta->descripcion ?? 'Sin nombre' }}</h4>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Tipo de Herramienta:</strong> {{ $herramienta->tipoHerramienta->tipo_herramienta ?? '-' }}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{ $herramienta->estado->estado ?? '-' }}</li>
                <li class="list-group-item"><strong>Fecha de Adquisición:</strong> {{ $herramienta->fecha_adquisicion ?? '-' }}</li>
            </ul>
            <h5 class="mt-4">Historial de Préstamos</h5>
            @if($herramienta->prestamos && count($herramienta->prestamos))
                <ul class="list-group">
                    @foreach($herramienta->prestamos as $prestamo)
                        <li class="list-group-item">
                            <strong>Fecha de Préstamo:</strong> {{ $prestamo->fecha_prestamo ?? '-' }}<br>
                            <strong>Usuario:</strong> {{ $prestamo->usuario->persona->primer_nombre ?? '-' }} {{ $prestamo->usuario->persona->primer_apellido ?? '' }}<br>
                            <strong>Fecha de Devolución:</strong> {{ $prestamo->fecha_devolucion ?? '-' }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay préstamos registrados.</p>
            @endif
            <h5 class="mt-4">Historial de Eventos</h5>
            @if($historial->count())
                <ul class="list-group">
                    @foreach($historial as $evento)
                        <li class="list-group-item">
                            <strong>Fecha:</strong> {{ $evento->fecha }}<br>
                            <strong>Tipo de evento:</strong> {{ ucfirst($evento->tipo_evento) }}<br>
                            <strong>Descripción:</strong> {{ $evento->descripcion ?? '-' }}
                            @if($evento->usuario)
                                <br><strong>Usuario:</strong> {{ $evento->usuario->name ?? $evento->usuario->email ?? '-' }}
                            @endif
                            @if($evento->reporte_id)
                                <br><a href="{{ route('reportes.show', $evento->reporte_id) }}" target="_blank">Ver reporte relacionado</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay eventos registrados en la hoja de vida.</p>
            @endif
        </div>
    </div>
    <a href="{{ route('historial.index') }}" class="btn btn-secondary">Volver al Historial</a>
</div>
@endsection
