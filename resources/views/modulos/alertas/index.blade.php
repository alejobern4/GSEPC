@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('dashboard') }}" class="btn-pequeño dashboard-buttondos me-3 ">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <h2 class="mb-0">Mis Alertas</h2>
    </div>
    @if($alertas->count())
        <div class="list-group">
            @foreach($alertas as $alerta)
                <div class="list-group-item list-group-item-action mb-2">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            {{ $alerta->tipoAlerta->nombre ?? 'Alerta' }}
                            ({{ $alerta->detalleVehiculo->placa ?? 'Sin placa' }})
                            -
                            @php
                                // Determinar el tipo de documento y la fecha correspondiente
                                $tipo = '';
                                $fecha = '';
                                $mensaje = strtolower($alerta->email_alerta ?? '');
                                if(str_contains($mensaje, 'soat')) {
                                    $tipo = 'SOAT';
                                    $fecha = $alerta->detalleVehiculo->fecha_soat;
                                } elseif(str_contains($mensaje, 'técnico-mecánica') || str_contains($mensaje, 'tecnomecánica') || str_contains($mensaje, 'tecnomecanica')) {
                                    $tipo = 'Tecnomecánica';
                                    $fecha = $alerta->detalleVehiculo->fecha_tecnomecanica;
                                } elseif(str_contains($mensaje, 'mantenimiento')) {
                                    $tipo = 'Mantenimiento';
                                    $fecha = $alerta->detalleVehiculo->fecha_ultimo_mantenimiento;
                                }
                                // Determinar tipo de alerta según la fecha
                                $tipoAlertaDinamico = '';
                                if($fecha) {
                                    $fechaVencimiento = \Carbon\Carbon::parse($fecha);
                                    $hoy = \Carbon\Carbon::now();
                                    $diasDiferencia = $hoy->diffInDays($fechaVencimiento, false);
                                    if($diasDiferencia > 0 && $diasDiferencia <= 15) {
                                        $tipoAlertaDinamico = 'Preventiva';
                                    } elseif($diasDiferencia === 0) {
                                        $tipoAlertaDinamico = 'A tiempo';
                                    } elseif($diasDiferencia < 0) {
                                        $tipoAlertaDinamico = 'Correctiva';
                                    }
                                }
                            @endphp
                            {{ $tipo }}
                        </h5>
                        <small>{{ $alerta->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <p class="mb-1">{{ $alerta->mensaje ?? '' }}</p>
                    <ul class="mb-1 ms-3">
                        <li><strong>Mensaje:</strong> {{ $alerta->email_alerta ?? 'Sin mensaje' }}</li>
                        <li><strong>Tipo de alerta:</strong> {{ $tipoAlertaDinamico ?: ($alerta->tipoAlerta->nombre ?? 'N/A') }}</li>
                        <li><strong>Placa:</strong> {{ $alerta->detalleVehiculo->placa ?? 'Sin placa' }}</li>
                        <li><strong>Fecha vencimiento:</strong> {{ $fecha ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $alertas->links() }}
        </div>
    @else
        <div class="alert alert-info">No tienes alertas.</div>
    @endif
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush
