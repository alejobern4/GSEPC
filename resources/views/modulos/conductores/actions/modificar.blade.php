@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modificar Conductor</h1>
    <form action="{{ route('conductores.update', $conductor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="primer_nombre" class="form-label">Primer Nombre</label>
            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $conductor->primer_nombre) }}" required>
        </div>
        <div class="mb-3">
            <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $conductor->segundo_nombre) }}">
        </div>
        <div class="mb-3">
            <label for="primer_apellido" class="form-label">Primer Apellido</label>
            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $conductor->primer_apellido) }}" required>
        </div>
        <div class="mb-3">
            <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $conductor->segundo_apellido) }}">
        </div>
        <div class="mb-3">
            <label for="num_documento" class="form-label">Número de Documento</label>
            <input type="text" class="form-control" id="num_documento" name="num_documento" value="{{ old('num_documento', $conductor->num_documento) }}" required>
        </div>
        <div class="mb-3">
            <label for="id_tipdocumento" class="form-label">Tipo de Documento</label>
            <select class="form-control" id="id_tipdocumento" name="id_tipdocumento" required>
                @foreach($tipos_documento as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('id_tipdocumento', $conductor->id_tipdocumento) == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipo_documento }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush