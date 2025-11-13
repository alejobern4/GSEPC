@extends('layouts.modulos')

@section('content')
<div class="container">
    <h1>Historial de Elementos y Vehículos</h1>
    <p>En esta sección puedes consultar y gestionar las hojas de vida de todos los elementos del almacén y los vehículos registrados, incluyendo información relevante como fecha de adquisición, historial de mantenimiento y estado actual.</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Nombre/Descripción</th>
                <th>Fecha de Adquisición</th>
                <th>Historial de Mantenimiento</th>
                <th>Estado Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ is_array($item) ? ($item['tipo'] ?? '') : $item->tipo }}</td>
                <td>{{ is_array($item) ? ($item['nombre'] ?? $item['descripcion'] ?? '') : ($item->nombre ?? $item->descripcion) }}</td>
                <td>{{ is_array($item) ? ($item['fecha_adquisicion'] ?? '') : $item->fecha_adquisicion }}</td>
                <td>
                    <a href="{{ route('historial.mantenimientos', is_array($item) ? ($item['id'] ?? '') : $item->id) }}" class="btn btn-info btn-sm">Ver Historial</a>
                </td>
                <td>{{ is_array($item) ? ($item['estado'] ?? '') : $item->estado }}</td>
                <td>
                    <a href="{{ route('historial.editar', is_array($item) ? ($item['id'] ?? '') : $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
