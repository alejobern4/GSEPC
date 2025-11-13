@extends('layouts.modulos')

@section('title', 'Vehiculos - EPC')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloseliminarvehiculo.css') }}">
@endpush

@section('content')
    <div class="actions-vehiculos">
        <a href="{{ route('vehiculos.index') }}" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver a Vehículos
        </a>
    </div>

    <h1 class="title">Eliminar Vehículo</h1>

    <div class="delete-vehicle-container">
        <div class="search-filter">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Buscar por placa...">
            </div>
            <select id="filterType">
                <option value="all">Todos los vehículos</option>
                <option value="camioneta">Camiones</option>
                <option value="camioneta">Camionetas</option>
                <option value="moto">Motos</option>
            </select>
        </div>

        <div class="vehicle-list" id="vehicleList">
            @foreach($vehiculos as $vehiculo)
                @php $detalle = $vehiculo->detalleVehiculo->first(); @endphp
                @php $tipo = optional($vehiculo->tipoVehiculo)->tipo_vehiculo ?? 'Otro'; @endphp
                <div class="vehicle-item" data-placa="{{ strtolower(optional($detalle)->placa ?? '') }}" data-tipo="{{ strtolower($tipo) }}">
                    @if(optional($detalle)->imagen_vehiculo)
                        <img class="vehicle-image" src="data:image/jpeg;base64,{{ base64_encode($detalle->imagen_vehiculo) }}" alt="{{ optional($detalle)->placa }}">
                    @else
                        <img class="vehicle-image" src="{{ asset('img/car.webp') }}" alt="{{ optional($detalle)->placa }}">
                    @endif
                    <div class="vehicle-info">
                        <h3>{{ optional($detalle)->placa ?? 'Sin placa' }}</h3>
                        <p><strong>Modelo:</strong> {{ $vehiculo->modelo_vehiculo ?? 'N/A' }}</p>
                        <p><strong>Marca:</strong> {{ $vehiculo->marca_vehiculo ?? 'N/A' }}</p>
                    </div>
                            <div style="margin-top:1rem;">
                        <form method="POST" action="{{ route('vehiculos.destroy', $vehiculo->id) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete-item" onclick="openDeleteModal(event, this.form, '{{ optional($detalle)->placa ?? $vehiculo->id }}')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="delete-confirm-modal" id="deleteModal" style="display:none;">
            <div class="modal-content">
                <span class="close-modal" id="closeModal">&times;</span>
                <h3>Confirmar Eliminación</h3>
                <p id="modalMessage">¿Estás seguro que deseas eliminar este vehículo?</p>
                <div class="modal-actions">
                    <button id="confirmDelete" class="btn-delete">Eliminar</button>
                    <button id="cancelDelete" class="btn-cancel">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/agregarvehiculo.js') }}"></script>
    <script>
        let currentDeleteForm = null;
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            const closeModal = document.getElementById('closeModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');

            function closeDeleteModal() {
                if (deleteModal) deleteModal.style.display = 'none';
                currentDeleteForm = null;
                document.body.style.overflow = '';
            }

            if (closeModal) closeModal.addEventListener('click', closeDeleteModal);
            if (cancelDelete) cancelDelete.addEventListener('click', closeDeleteModal);
            if (confirmDelete) confirmDelete.addEventListener('click', () => { if (currentDeleteForm) currentDeleteForm.submit(); });

            // close when clicking on overlay (outside modal content)
            if (deleteModal) deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        });

        function openDeleteModal(e, form, placa) {
            e.preventDefault();
            currentDeleteForm = form;
            const deleteModal = document.getElementById('deleteModal');
            const modalMessage = document.getElementById('modalMessage');
            if (modalMessage) modalMessage.textContent = `¿Estás seguro que deseas eliminar el vehículo ${placa}?`;
            if (deleteModal) {
                deleteModal.style.display = 'flex';
                // prevent body scroll while modal open
                document.body.style.overflow = 'hidden';
            }
        }

        // Filtrado cliente: búsqueda por placa y filtro por tipo
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterType = document.getElementById('filterType');
            const vehicleList = document.getElementById('vehicleList');

            function applyFilter() {
                const q = (searchInput ? searchInput.value.toLowerCase().trim() : '');
                const type = (filterType ? filterType.value.toLowerCase() : 'all');
                const items = vehicleList ? vehicleList.querySelectorAll('.vehicle-item') : [];
                items.forEach(item => {
                    const placa = item.getAttribute('data-placa') || '';
                    const tipo = (item.getAttribute('data-tipo') || '').toLowerCase();
                    const matchesQ = q === '' || placa.includes(q);
                    const matchesType = type === 'all' || tipo.includes(type);
                    if (matchesQ && matchesType) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            if (searchInput) searchInput.addEventListener('input', applyFilter);
            if (filterType) filterType.addEventListener('change', applyFilter);
        });
    </script>
@endpush