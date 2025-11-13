@extends('layouts.modulos')

@section('title', 'Editar Vehículo')

@section('content')
<div class="container">
    <h1>Modificar Vehículo</h1>
    <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa', $vehiculo->placa) }}" required>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo_vehiculo_id" class="form-label">Tipo de Vehículo</label>
            <input type="text" class="form-control" id="tipo_vehiculo_id" name="tipo_vehiculo_id" value="{{ old('tipo_vehiculo_id', $vehiculo->tipo_vehiculo_id) }}" required>
        </div>
        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" class="form-control" id="anio" name="anio" value="{{ old('anio', $vehiculo->anio) }}" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $vehiculo->color) }}">
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
