@extends('layouts.herramientas')

@section('content')
<div class="container">
    <h1>Eliminar Herramienta</h1>
    <div class="alert alert-danger">
        <p>¿Estás seguro que deseas eliminar esta herramienta?</p>
    </div>
    <form action="{{ route('herramientas.destroy', $herramienta->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
