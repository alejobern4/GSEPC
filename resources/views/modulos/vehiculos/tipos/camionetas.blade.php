@extends('layouts.vehiculos')

@section('content')
<h2 class="mb-4">Camionetas</h2>
<div class="vehicle-grid">
    @foreach ($camionetas as $camioneta)
        @php
            $detalleVehiculos = isset($camioneta->detalleVehiculo) ? $camioneta->detalleVehiculo : [];
        @endphp
        @foreach ($detalleVehiculos as $detalle)
            <div class="vehicle-card">
                @if ($detalle->imagen_vehiculo)
                    <img src="data:image/jpeg;base64,{{ base64_encode($detalle->imagen_vehiculo) }}" alt="Vehículo {{ $detalle->placa }}">
                @else
                    <img src="{{ asset('img/car.webp') }}" alt="Vehículo {{ $detalle->placa }}">
                @endif
                <div class="vehicle-plate {{
                    match(strtolower($detalle->estadoVehiculo->estado ?? '')) {
                        'disponible' => 'estado-disponible',
                        'prestado' => 'estado-prestado',
                        'fuera de servicio' => 'estado-fuera-servicio',
                        'inactivo' => 'estado-inactivo',
                        default => ''
                    }
                }}">
                    {{ $detalle->placa }}
                </div>
                <div class="tarjeta" onclick="expandirTarjetaModal(this)">
                    <div class="resumen">DETALLES</div>
                    <div class="detalle">
                        <div class="vehicle-plate {{
                            match(strtolower($detalle->estadoVehiculo->estado ?? '')) {
                                'disponible' => 'estado-disponible',
                                'prestado' => 'estado-prestado',
                                'fuera de servicio' => 'estado-fuera-servicio',
                                'inactivo' => 'estado-inactivo',
                                default => ''
                            }
                        }}">{{ $detalle->placa }}</div>
                        <p><strong>Modelo:</strong> {{ is_array($camioneta) ? ($camioneta['modelo_vehiculo'] ?? '') : $camioneta->modelo_vehiculo }}</p>
                        <p><strong>Marca:</strong> {{ is_array($camioneta) ? ($camioneta['marca_vehiculo'] ?? '') : $camioneta->marca_vehiculo }}</p>
                        <p><strong>Año:</strong> {{ $detalle->año ?? 'No registrado' }}</p>
                        <p><strong>Capacidad:</strong> {{ $detalle->capacidad ?? '2' }} pasajeros</p>
                        <p><strong>Conductor:</strong> {{
                            optional(
                                is_iterable($camioneta->detalleVehiculo) ? $camioneta->detalleVehiculo->first()->persona ?? null : $camioneta->detalleVehiculo->persona ?? null
                            )->nombre_completo ?? 'No asignado'
                        }}</p>
                        <p><strong>Soat:</strong> {{ $detalle->soat_estado ?? 'No registrado' }}</p>
                        <p><strong>Tecnomecánica:</strong> {{ $detalle->tecno_estado ?? 'No registrada' }}</p>
                        @if(strtolower($detalle->estadoVehiculo->estado ?? '') === 'prestado')
                            <form method="POST" action="{{ route('vehiculos.devolver') }}" style="margin-top:1rem;">
                                @csrf
                                <input type="hidden" name="vehiculo_id" value="{{ $camioneta->id }}">
                                <button type="submit" class="btn btn-warning">Devolver</button>
                            </form>
                        @elseif(strtolower($detalle->estadoVehiculo->estado ?? '') === 'disponible')
                            <a href="{{ route('vehiculos.asignar.store') }}" class="btn btn-success" style="margin-top:1rem;">Asignar</a>
                        @endif
                        <a href="{{ route('historial.vehiculo', $camioneta->id) }}"
                            class="btn btn-info"
                            style="margin-top: 10px; background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;">
                            SOAT Y TECHNO / Ver Historial
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<div id="modalVehiculo" onclick="cerrarModal()">
    <div class="contenido-modal" onclick="event.stopPropagation()">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <img id="modalImagen" src="" alt="Imagen del vehículo">
        <div id="modalDetalles"></div>
    </div>
</div>

<br>

<div class="action-buttons" style="text-align: right; margin: 0 2rem 1rem 0; position: static;">
    <a href="{{ route('vehiculos.create', ['tipo_vehiculos' => 'Camionetas']) }}" class="btn-agregar-vehiculo btn-verde" title="Agregar camioneta">
        <i class="fas fa-plus"></i> Agregar Camioneta
    </a>
</div>

@endsection