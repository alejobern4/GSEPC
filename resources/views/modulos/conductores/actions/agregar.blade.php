@extends('layouts.conductores')

@section('content')
<div class="container">
    <h1>Agregar Conductor</h1>
    <form action="{{ route('conductores.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="primer_nombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="primer_apellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="num_documento" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="num_documento" name="num_documento" value="{{ old('num_documento') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="id_tipdocumento" class="form-label">Tipo de Documento</label>
                <select name="id_tipdocumento" id="id_tipdocumento" class="form-control" required>
                    <option value="">Seleccione...</option>
                    @foreach($tipos_documento as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('id_tipdocumento') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->tipo_documento ?? $tipo->nombre ?? 'Tipo' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
