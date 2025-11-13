@extends('layouts.modulos')

@vite(['resources/js/vehiculos.js', 'resources/js/modulos.js'])

@section('links')
    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endsection

@section('content')
<main class="main-content">
    <div class="vehicle-grid">
        <div class="vehicle-card">
            @yield('content')
        </div>
    </div>

    <div class="vehicle-category">
        <div class="cuadroVehiculos">
            <div class="actions-vehiculos">
                <div class="action-buttons">
                    <a href="{{ route('vehiculos.create') }}" class="btn-agregar-vehiculo">
                        <i class="fas fa-plus"></i> Añadir Vehículo
                    </a>
                    <a href="{{ route('vehiculos.eliminate') }}" class="btn-eliminar-vehiculo">
                        <i class="fas fa-trash-alt"></i> Eliminar Vehículo
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

@push('styles')
<style>
.btn-verde {
    background: #1abc6c !important;
    color: #fff !important;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: background 0.2s;
    margin: 1rem 0 0 0;
    display: inline-block;
    text-decoration: none !important;
}
.btn-verde:hover, .btn-verde:focus {
    background: #159c56 !important;
    color: #fff !important;
    text-decoration: none !important;
}
.action-buttons {
    /* No floating, just right aligned */
    position: static;
    text-align: right;
    margin: 0 2rem 1rem 0;
}
@media (max-width: 600px) {
    .action-buttons { margin: 0 1rem 1rem 0; }
    .btn-verde { padding: 0.5rem 1.2rem; font-size: 1rem; }
}
</style>
@endpush
@endsection