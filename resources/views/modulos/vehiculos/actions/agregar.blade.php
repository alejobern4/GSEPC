@extends('layouts.modulos')

@section('title', 'Vehiculos - EPC')

@section('content')
<div class="wrapper">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Agregar Vehículo</title>
        <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/estilosagregarvehiculo.css') }}">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>

    <div class="content">
        <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong>Añadir Vehículo</strong></h1>
        
        <div class="add-vehicle-container">
            <div class="actions-vehiculos">
                <a href="{{ route('vehiculos.index') }}" class="btn-agregar-vehiculo">
                    <i class="fas fa-arrow-left"></i> Volver a Vehículos
                </a>
            </div>

            <form id="formAgregarVehiculo" class="add-vehicle-form" method="POST" action="{{ route('vehiculos.store') }}" enctype="multipart/form-data">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2><i class="fas fa-plus-circle"></i> Información del Vehículo</h2>

                <div class="form-group">
                    <label for="tipo_vehiculos">Tipo de Vehículo:</label>
                    <select id="tipo_vehiculos" name="tipo_vehiculos" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="Compactadores" {{ (isset($tipoSeleccionado) && $tipoSeleccionado == 'Compactadores') ? 'selected' : '' }}>Compactador</option>
                        <option value="Camionetas" {{ (isset($tipoSeleccionado) && $tipoSeleccionado == 'Camionetas') ? 'selected' : '' }}>Camioneta</option>
                        <option value="Motos" {{ (isset($tipoSeleccionado) && $tipoSeleccionado == 'Motos') ? 'selected' : '' }}>Moto</option>
                        <option value="Otro" {{ (isset($tipoSeleccionado) && $tipoSeleccionado == 'Otro') ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="marcaVehiculo">Marca:</label>
                    <select id="marcaVehiculo" name="marcaVehiculo" required>
                        <option value="">Seleccione una marca</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Ford">Ford</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Honda">Honda</option>
                        <option value="BMW">BMW</option>
                        <option value="Mercedes">Mercedes-Benz</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <input type="text" id="placa" name="placa" required placeholder="Ej: ABC-123">
                </div>

                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" required placeholder="Ej: Ford F-150">
                </div>

                <div class="form-group">
                    <label for="anio">Año:</label>
                    <input type="number" id="anio" name="anio" min="1900" max="2025" required placeholder="Ej: 2020">
                </div>

                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" required placeholder="Ej: Rojo">
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen del Vehículo:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="fechaSoat">Fecha SOAT:</label>
                    <input type="date" id="fechaSoat" name="fechaSoat" required>
                </div>

                <div class="form-group">
                    <label for="fecha_tecnomecanica">Fecha Tecnomecánica:</label>
                    <input type="date" id="fecha_tecnomecanica" name="fecha_tecnomecanica" required>
                </div>

                <div class="form-group">
                    <label for="fechaSolicitud">Fecha de Solicitud:</label>
                    <input type="date" id="fechaSolicitud" name="fechaSolicitud" required>
                </div>

                <div class="form-group">
                    <label for="fechaDevolucion">Fecha de Devolución:</label>
                    <input type="date" id="fechaDevolucion" name="fechaDevolucion" required>
                </div>

                <div class="form-group">
                    <label for="fechaUltimoMantenimiento">Fecha Último Mantenimiento:</label>
                    <input type="date" id="fechaUltimoMantenimiento" name="fechaUltimoMantenimiento" required>
                </div>

                <div class="form-group">
                    <label for="descripcionUltimoMantenimiento">Descripción Último Mantenimiento:</label>
                    <textarea id="descripcionUltimoMantenimiento" name="descripcionUltimoMantenimiento" rows="3" placeholder="Detalles del último mantenimiento..."></textarea>
                </div>

                <div class="form-group">
                    <label for="persona_id">Conductor/Persona asignada:</label>
                    <select id="persona_id" name="persona_id" required>
                        <option value="">Seleccione una persona</option>
                        @foreach(App\Models\Persona::all() as $persona)
                            <option value="{{ $persona->id }}">
                                {{ $persona->primer_nombre }} {{ $persona->primer_apellido }} - {{ $persona->num_documento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Guardar Vehículo
                </button>
            </form>
        </div>
    </div>
</div>

@vite('resources/js/agregarvehiculo.js')
@endsection
