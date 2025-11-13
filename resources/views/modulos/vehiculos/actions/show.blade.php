<form action="{{ route('vehiculos.cambiarEstado', $vehiculo->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="estado">Estado del Vehículo:</label>
        <select name="id_estado" id="estado" class="form-control" required>
            @foreach($estados as $estado)
                <option value="{{ $estado->id }}" 
                    {{ $vehiculo->detalleVehiculo->id_estado == $estado->id ? 'selected' : '' }}
                    class="estado-{{ strtolower($estado->estado) }}">
                    {{ $estado->estado }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Estado</button>
</form>