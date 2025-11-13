document.addEventListener("DOMContentLoaded", () => {
    const backButton = document.getElementById("backButton");

    if (backButton) {
        backButton.addEventListener("click", showAll);
    }
});

function expandirTarjetaModal(tarjeta) {
    // Busca el modal y sus elementos
    const modal = document.getElementById('modalVehiculo');
    const modalImagen = document.getElementById('modalImagen');
    const modalDetalles = document.getElementById('modalDetalles');

    // Cerrar cualquier modal abierto antes
    if (modal) {
        modal.style.display = 'none';
    }

    // Busca la imagen dentro de la tarjeta
    const img = tarjeta.closest('.vehicle-card').querySelector('img');
    const imgSrc = img ? img.src : '';
    // Busca los detalles
    const detalles = tarjeta.querySelector('.detalle').innerHTML;

    // Asigna la imagen y los detalles al modal
    if (modalImagen) modalImagen.src = imgSrc;
    if (modalDetalles) modalDetalles.innerHTML = detalles;
    if (modal) modal.style.display = 'flex';
}

function cerrarModal() {
    const modal = document.getElementById('modalVehiculo');
    if (modal) {
        modal.style.display = 'none';
    }
}

function showDetails(item) {
    const vehicles = document.querySelectorAll(".Item");
    vehicles.forEach(vehicle => {
        vehicle.style.display = "none";
    });

    item.style.display = "flex";
    document.getElementById("backButton").classList.remove("hidden");
}

function showAll() {
    document.querySelectorAll(".Item").forEach(vehicle => {
        vehicle.style.display = "flex";
    });

    document.getElementById("backButton").classList.add("hidden");
}

document.addEventListener('DOMContentLoaded', function() {
    // Agregar event listeners a todos los botones de detalles
    document.querySelectorAll('.btn-details').forEach(button => {
        button.addEventListener('click', function() {
            const vehiculoData = JSON.parse(this.getAttribute('data-vehiculo'));
            mostrarDetallesVehiculo(vehiculoData);
        });
    });
});

function mostrarDetallesVehiculo(vehiculo) {
    const modal = document.getElementById('modalVehiculo');
    const modalImagen = document.getElementById('modalImagen');
    const modalDetalles = document.getElementById('modalDetalles');

    // Configurar la imagen
    if (vehiculo.imagen_vehiculo) {
        modalImagen.src = `data:image/jpeg;base64,${vehiculo.imagen_vehiculo}`;
    } else {
        modalImagen.src = '/img/car.webp';
    }

    // Construir el HTML para los detalles
    modalDetalles.innerHTML = `
        <div class="detalles-vehiculo">
            <div class="detalle-item"><strong>Placa:</strong> ${vehiculo.placa}</div>
            <div class="detalle-item"><strong>Marca:</strong> ${vehiculo.marca_vehiculo}</div>
            <div class="detalle-item"><strong>Modelo:</strong> ${vehiculo.modelo_vehiculo}</div>
            <div class="detalle-item"><strong>Estado:</strong> ${vehiculo.estado}</div>
        </div>
    `;

    // Mostrar el modal
    modal.style.display = 'flex';
}

// Cerrar el modal al hacer clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('modalVehiculo');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

window.expandirTarjetaModal = expandirTarjetaModal;
window.cerrarModal = cerrarModal;