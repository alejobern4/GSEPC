@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignar Herramienta</h1>
    <form action="{{ route('herramientas.asignar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="herramienta_id" class="form-label">Herramienta</label>
            <select class="form-control" id="herramienta_id" name="herramienta_id" required>
                <option value="">Seleccione una herramienta</option>
                @foreach($herramientas as $herramienta)
                    <option value="{{ $herramienta->id }}">{{ $herramienta->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="persona_id" class="form-label">Persona</label>
            <select class="form-control" id="persona_id" name="persona_id" required>
                <option value="">Seleccione una persona</option>
                @foreach($personas as $persona)
                    <option value="{{ $persona->id }}">{{ $persona->nombre }} {{ $persona->apellido }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Asignar</button>
        <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<footer class="footer mt-5 py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; {{ date('Y') }} EPC - Todos los derechos reservados.</span>
    </div>
</footer>
@endsection
