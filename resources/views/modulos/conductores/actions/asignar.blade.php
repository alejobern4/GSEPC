@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignar Conductor</h1>
    <form action="{{ route('conductores.asignar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="vehiculo_id" class="form-label">Vehículo</label>
            <select class="form-control" id="vehiculo_id" name="vehiculo_id" required>
                <option value="">Seleccione un vehículo</option>
                @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa ?? $vehiculo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="conductor_id" class="form-label">Conductor</label>
            <select class="form-control" id="conductor_id" name="conductor_id" required>
                <option value="">Seleccione un conductor</option>
                @foreach($conductores as $conductor)
                    <option value="{{ $conductor->id }}">{{ $conductor->nombre }} {{ $conductor->apellido }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Asignar</button>
        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<footer class="footer mt-5 py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; {{ date('Y') }} EPC - Todos los derechos reservados.</span>
    </div>
</footer>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush