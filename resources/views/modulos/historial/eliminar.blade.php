@extends('layouts.modulos')

@section('content')
<div class="container">
    <h1>Eliminar Elemento o Vehículo del Historial</h1>
    <div class="alert alert-danger">
        <p>¿Estás seguro que deseas eliminar este registro del historial?</p>
    </div>
    <form action="{{ route('historial.destroy', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <a href="{{ route('historial.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
