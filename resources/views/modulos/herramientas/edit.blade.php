@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modificar Herramienta</h1>
    <form action="{{ route('herramientas.update', $herramienta->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $herramienta->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo_herramienta_id" class="form-label">Tipo de Herramienta</label>
            <input type="text" class="form-control" id="tipo_herramienta_id" name="tipo_herramienta_id" value="{{ old('tipo_herramienta_id', $herramienta->tipo_herramienta_id) }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $herramienta->descripcion) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<footer class="footer mt-5 py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; {{ date('Y') }} EPC - Todos los derechos reservados.</span>
    </div>
</footer>
@endsection
