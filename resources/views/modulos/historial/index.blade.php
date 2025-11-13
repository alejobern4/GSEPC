@extends('layouts.historial')

@section('content')
<div class="container">
    <h1>Historial de Elementos y Vehículos</h1>
    <p>Consulta y gestiona las hojas de vida de todos los elementos del almacén y vehículos registrados, incluyendo fecha de adquisición, historial de mantenimiento y estado actual.</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Tipo de Vehículo</th>
                <th>Placa</th>
                <th>Usuario Asignado</th>
                <th>Historial de Mantenimiento</th>
                <th>Estado Actual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ is_array($item) ? ($item['tipo'] ?? '') : $item->tipo }}</td>
                <td>{{ is_array($item) ? ($item['marca'] ?? '') : $item->marca }}</td>
                <td>{{ is_array($item) ? ($item['modelo'] ?? '') : $item->modelo }}</td>
                <td>{{ is_array($item) ? ($item['tipo_vehiculo'] ?? '') : $item->tipo_vehiculo }}</td>
                <td>{{ is_array($item) ? ($item['placa'] ?? '') : $item->placa }}</td>
                <td>{{ is_array($item) ? ($item['usuario'] ?? '') : $item->usuario }}</td>
                <td>
                    @if((is_array($item) ? ($item['tipo'] ?? '') : $item->tipo) === 'Vehículo')
                        <a href="{{ route('historial.vehiculo', is_array($item) ? ($item['id'] ?? '') : $item->id) }}" class="btn btn-info btn-sm">Ver Hoja de Vida</a>
                    @else
                        <a href="{{ route('historial.herramienta', is_array($item) ? ($item['id'] ?? '') : $item->id) }}" class="btn btn-info btn-sm">Ver Hoja de Vida</a>
                    @endif
                </td>
                <td>{{ is_array($item) ? ($item['estado'] ?? '') : $item->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection