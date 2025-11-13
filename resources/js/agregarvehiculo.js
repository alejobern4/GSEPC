document.addEventListener('DOMContentLoaded', function() {
    // Obtener parámetro de URL para preseleccionar tipo
    const urlParams = new URLSearchParams(window.location.search);
    const tipoPreseleccionado = urlParams.get('tipo');
    
    if (tipoPreseleccionado) {
        document.getElementById('tipoVehiculo').value = tipoPreseleccionado;
    }

    const formAgregarVehiculo = document.getElementById('formAgregarVehiculo');
    
    formAgregarVehiculo.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Crear FormData para enviar archivos
        const formData = new FormData(formAgregarVehiculo);
        
        // Enviar datos al servidor
        fetch('/vehiculos', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Vehículo agregado correctamente');
                window.location.href = '/vehiculos';
            } else {
                alert('Error al agregar el vehículo: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al agregar el vehículo');
        });
    });
    
    // Validación de placa en formato ABC-123
    document.getElementById('placa').addEventListener('input', function(e) {
        const placa = e.target.value;
        const regex = /^[A-Z]{3}-\d{3}$/;
        
        if (placa && !regex.test(placa)) {
            e.target.setCustomValidity('Formato de placa inválido. Use formato ABC-123');
        } else {
            e.target.setCustomValidity('');
        }
    });
});

function cerrarModal() {
    document.getElementById('modalVehiculo').style.display = 'none';
}

// Función para confirmar eliminación
function confirmarEliminacion(placa, tipo) {
    const modal = document.createElement('div');
    modal.id = 'confirmModal';
    modal.innerHTML = `
        <div class="modal-content-confirm">
            <h3>Confirmar Eliminación</h3>
            <p>¿Estás seguro que deseas eliminar el vehículo ${placa}?</p>
            <div class="modal-actions-confirm">
                <button class="btn-cancel" onclick="cerrarModal()">Cancelar</button>
                <button class="btn-confirm" onclick="eliminarVehiculo('${placa}', '${tipo}')">Eliminar</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
    modal.style.display = 'flex';
}

function cerrarModal() {
    const modal = document.getElementById('confirmModal');
    if (modal) {
        modal.style.display = 'none';
        setTimeout(() => modal.remove(), 300);
    }
}

function eliminarVehiculo(placa, tipo) {
    // Aquí iría la lógica para eliminar el vehículo
    console.log(`Eliminando vehículo ${placa} de tipo ${tipo}`);
    
    // Simular eliminación (en un caso real sería una petición AJAX)
    alert(`Vehículo ${placa} eliminado correctamente`);
    cerrarModal();
    
    // Recargar la lista de vehículos (o eliminar el elemento del DOM)
    // location.reload(); // Opción 1: Recargar página
    // Opción 2: Eliminar el elemento visualmente sin recargar
}