document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menu-btn');
    const menuItemsDropDown = document.querySelectorAll('.menu-item-dropdown');
    const menuItemsStatic = document.querySelectorAll('.menu-item-static');

    // Alternar el sidebar
    if (menuBtn) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('minimize');
            document.body.classList.toggle('sidebar-minimized');
        });
    }

    // Menús desplegables
    menuItemsDropDown.forEach((menuItem) => {
        const menuLink = menuItem.querySelector('.menu-link');
        const subMenu = menuItem.querySelector('.sub-menu');
        const arrow = menuLink.querySelector('.bxs-down-arrow');

        menuLink.addEventListener('click', (e) => {
            // Si el menú está minimizado, no hacer nada
            if (sidebar.classList.contains('minimize')) return;

            // Si el clic fue en el ícono de flecha o en el span, prevenir la navegación
            if (e.target === arrow || e.target === arrow.parentElement) {
                e.preventDefault();
                const isActive = menuItem.classList.toggle('sub-menu-toggle');
                
                // Rotar la flecha
                arrow.style.transform = isActive ? 'rotate(180deg)' : 'rotate(0)';
                
                // Ajustar la altura del submenu
                if (subMenu) {
                    subMenu.style.height = isActive ? `${subMenu.scrollHeight}px` : '0';
                    subMenu.style.padding = isActive ? '0.4rem 0' : '0';
                }
                // Cerrar otros submenús
                menuItemsDropDown.forEach((item) => {
                    if (item !== menuItem) {
                        const otherSubmenu = item.querySelector('.sub-menu');
                        const otherArrow = item.querySelector('.bxs-down-arrow');
                        if (otherSubmenu) {
                            item.classList.remove('sub-menu-toggle');
                            otherSubmenu.style.height = '0';
                            otherSubmenu.style.padding = '0';
                            if (otherArrow) {
                                otherArrow.style.transform = 'rotate(0)';
                            }
                        }
                    }
                });
            }
        });
    });

    // Cerrar submenús cuando el mouse entra en un menú estático
    menuItemsStatic.forEach((menuItem) => {
        menuItem.addEventListener('mouseenter', () => {
            if (sidebar.classList.contains('minimize')) return;

            menuItemsDropDown.forEach((item) => {
                const subMenu = item.querySelector('.sub-menu');
                const arrow = item.querySelector('.bxs-down-arrow');
                if (subMenu) {
                    item.classList.remove('sub-menu-toggle');
                    subMenu.style.height = '0';
                    subMenu.style.padding = '0';
                    if (arrow) {
                        arrow.style.transform = 'rotate(0)';
                    }
                }
            });
        });
    });
});

const menuToggleBtn = document.getElementById('menuToggleBtn');
if (menuToggleBtn) {
    menuToggleBtn.addEventListener('click', () => {
        document.body.classList.toggle('sidebar-hidden');
    });
}

// Manejo del scroll
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const sidebar = document.querySelector('.sidebar');
    const main = document.querySelector('main');
    
    if (window.scrollY > 0) {
        navbar.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
        sidebar.style.top = '0';
        sidebar.style.height = '100vh';
        main.style.marginTop = '0';
    } else {
        navbar.style.boxShadow = 'none';
        sidebar.style.top = '76px';
        sidebar.style.height = 'calc(100vh - 76px)';
        main.style.marginTop = '76px';
    }
});
function expandirTarjetaModal(elemento) {
    const detalle = elemento.querySelector('.detalle');
    if (detalle) {
        detalle.classList.toggle('visible');
    }
}