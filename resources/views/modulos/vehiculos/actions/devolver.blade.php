@extends('layouts.app')

@section('title', 'Asignar Vehículo')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h1>Asignar Vehículo</h1>
    <form action="{{ route('vehiculos.devolver') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipo_vehiculo_id" class="form-label">Tipo de Vehículo</label>
            <div class="input-group">
                <select class="form-control" id="tipo_vehiculo_id" name="tipo_vehiculo_id">
                    <option value="">Seleccione un tipo</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->tipo_vehiculo }}</option>
                    @endforeach
                </select>
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
        </div>
        <div class="mb-3" id="vehiculo-group" style="display:none;">
            <label for="vehiculo_id" class="form-label">Vehículo</label>
            <div class="input-group">
                <select class="form-control" id="vehiculo_id" name="vehiculo_id" required>
                    <option value="">Seleccione un vehículo</option>
                    @foreach($vehiculos as $vehiculo)
                        @if($vehiculo->vehiculo)
                            <option value="{{ $vehiculo->id }}" data-tipo="{{ $vehiculo->vehiculo->id_tipovehiculo }}">
                                {{ $vehiculo->placa }} - {{ $vehiculo->vehiculo->modelo_vehiculo }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <label for="persona_id" class="form-label">Persona</label>
            <div class="input-group">
                <select class="form-control" id="persona_id" name="persona_id" required>
                    <option value="">Seleccione una persona</option>
                    @foreach($personas as $persona)
                        <option value="{{ $persona->id }}">
                            {{ $persona->primer_nombre ?? $persona->nombre }} {{ $persona->primer_apellido ?? $persona->apellido }} - {{ $persona->num_documento ?? $persona->documento }}
                        </option>
                    @endforeach
                </select>
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Devolver</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
        <a href="http://127.0.0.1:8000/conductores" class="btn btn-primary" style="margin-left: 10px;">Crear Conductor</a>
    </form>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.getElementById('tipo_vehiculo_id');
    const vehiculoGroup = document.getElementById('vehiculo-group');
    const vehiculoSelect = document.getElementById('vehiculo_id');
    vehiculoGroup.style.display = 'none';
    tipoSelect.addEventListener('change', function() {
        const tipo = this.value;
        if (tipo === '') {
            vehiculoGroup.style.display = 'none';
            vehiculoSelect.value = '';
        } else {
            vehiculoGroup.style.display = '';
            Array.from(vehiculoSelect.options).forEach(opt => {
                if (!opt.value) return;
                opt.style.display = (opt.getAttribute('data-tipo') === tipo) ? '' : 'none';
            });
            vehiculoSelect.value = '';
        }
    });
});
</script>
@endpush