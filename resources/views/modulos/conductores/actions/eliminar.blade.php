@extends('layouts.conductores')

@section('content')
<div class="container">
    <h1>Eliminar Conductor</h1>
    <div class="alert alert-danger">
        <p>¿Estás seguro que deseas eliminar este conductor?</p>
    </div>
    <form action="{{ route('conductores.destroy', $conductor->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
