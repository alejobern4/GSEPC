@extends('layouts.modulos')

@section('content')
<h2>Historial de Documentos del Vehículo</h2>

<a href="javascript:history.back()" class="btn btn-outline-secondary mb-3">Volver</a>

<!-- Formulario para subir documento -->
<form method="POST" action="{{ route('vehiculos.documentos.subir', ['detalle' => $detalleVehiculo->id]) }}" enctype="multipart/form-data" style="margin-bottom: 2rem;">
    @csrf
    <div class="mb-3">
        <label for="documento"><strong>Seleccionar archivo:</strong></label>
        <input type="file" name="documento" id="documento" accept=".pdf,.jpg,.png" required class="form-control" />
    </div>
    <div class="mb-3">
        <label for="nombre"><strong>Nombre del archivo:</strong></label>
        <input type="text" name="nombre" id="nombre" placeholder="Ej: SOAT_vehiculo.pdf" class="form-control" required />
    </div>
    <div class="mb-3">
        <label for="fecha"><strong>Fecha del documento:</strong></label>
        <input type="date" name="fecha" id="fecha" class="form-control" required />
    </div>
    <button type="submit" class="btn btn-primary">Subir documento</button>
</form>

<!-- Historial de documentos -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha del documento</th>
            <th>Archivo</th>
            <th>Subido el</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalleVehiculo->documentos as $doc)
            <tr>
                <td>{{ $doc->nombre ?? 'Sin nombre' }}</td>
                <td>{{ $doc->fecha ?? 'Sin fecha' }}</td>
                <td>
                    @if(isset($doc->ruta) && $doc->ruta)
                        <a href="{{ asset('storage/' . $doc->ruta) }}" target="_blank">Ver</a>
                    @else
                        <span style="color:#888;">No disponible</span>
                    @endif
                </td>
                <td>{{ $doc->created_at ? $doc->created_at->format('d/m/Y H:i') : '' }}</td>
                <td>
                    @if(isset($doc->ruta) && $doc->ruta)
                        <a href="{{ route('vehiculos.documentos.ver', ['documento' => $doc->id]) }}" target="_blank" class="btn btn-sm btn-secondary">
                            Ver
                        </a>
                        <a href="{{ route('vehiculos.documentos.descargar', ['documento' => $doc->id]) }}" class="btn btn-sm btn-primary">
                            Descargar
                        </a>
                    @else
                        <span style="color:#888;">No disponible</span>
                    @endif
                    <form action="{{ route('vehiculos.documentos.eliminar', ['documento' => $doc->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este documento?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
