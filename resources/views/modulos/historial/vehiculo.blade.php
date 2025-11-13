@extends('layouts.modulos')

@section('content')
<div class="container">
    <h1>Hoja de Vida del Vehículo</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $vehiculo->detalleVehiculo->first()->placa ?? 'Sin placa' }}</h4>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Marca:</strong> {{ $vehiculo->marca_vehiculo ?? '-' }}</li>
                <li class="list-group-item"><strong>Modelo:</strong> {{ $vehiculo->modelo_vehiculo ?? '-' }}</li>
                <li class="list-group-item"><strong>Tipo de Vehículo:</strong> {{ $vehiculo->tipoVehiculo->tipo_vehiculo ?? '-' }}</li>
                <li class="list-group-item"><strong>Placa:</strong> {{ $vehiculo->detalleVehiculo->first()->placa ?? '-' }}</li>
                <li class="list-group-item"><strong>Conductor:</strong> 
                    @php
                        $detalle = $vehiculo->detalleVehiculo->first();
                        $persona = $detalle && $detalle->persona ? $detalle->persona : null;
                    @endphp
                    {{ $persona ? ($persona->primer_nombre . ' ' . $persona->primer_apellido) : 'No asignado' }}
                </li>
                <li class="list-group-item"><strong>Estado:</strong> {{ $vehiculo->estado ?? '-' }}</li>
                <li class="list-group-item"><strong>Fecha de Adquisición:</strong> {{ $vehiculo->fecha_adquisicion ?? '-' }}</li>
            </ul>
            <h5 class="mt-4">Historial de Mantenimientos</h5>
            @if($vehiculo->detalleVehiculo->first() && $vehiculo->detalleVehiculo->first()->mantenimientos && count($vehiculo->detalleVehiculo->first()->mantenimientos))
                <ul class="list-group">
                    @foreach($vehiculo->detalleVehiculo->first()->mantenimientos as $mantenimiento)
                        <li class="list-group-item">
                            <strong>Fecha:</strong> {{ $mantenimiento->fecha ?? '-' }}<br>
                            <strong>Descripción:</strong> {{ $mantenimiento->descripcion ?? '-' }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay mantenimientos registrados.</p>
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
