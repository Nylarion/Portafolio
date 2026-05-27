document.addEventListener("DOMContentLoaded", function() {

    // ==========================================
    // 1. SISTEMA DE NAVEGACIÓN DE LA BARRA LATERAL
    // ==========================================
    const sidebarLinks = document.querySelectorAll(".sidebar-links .nav-link");
    const dashboardSections = document.querySelectorAll(".dashboard-section");

    sidebarLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            // Evitamos el comportamiento por defecto de las anclas (#)
            e.preventDefault();

            // Quitamos la clase 'active' de todos los botones de la barra lateral
            sidebarLinks.forEach(item => item.classList.remove("active"));
            // Se la añadimos únicamente al botón clickeado
            this.classList.add("active");

            // Ocultamos todas las secciones del dashboard
            dashboardSections.forEach(section => section.classList.remove("active"));

            // Obtenemos el ID del href (ej: '#adm-herramientas')
            const targetId = this.getAttribute("href");
            const targetSection = document.querySelector(targetId);

            // Si la sección existe en el DOM, la hacemos visible
            if (targetSection) {
                targetSection.classList.add("active");
            }
        });
    });


    // ==========================================
    // 2. SISTEMA DE MODALES DE CONFIRMACIÓN (TU CÓDIGO)
    // ==========================================
    const modalEl = document.getElementById('modalConfirmacionGlobal');
    
    // Verificación de existencia para evitar errores si ejecutas el JS en vistas públicas sin el modal
    if (modalEl) {
        const bsConfirmModal = new bootstrap.Modal(modalEl);
        const textoMensaje = document.getElementById('textoMensajeConfirmacion');
        const btnAceptar = document.getElementById('btnAceptarConfirmacion');
        let accionPendiente = null;

        // Formularios con confirmación previa
        const formularios = document.querySelectorAll('.js-confirm-form');
        formularios.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (form.dataset.confirmado === 'true') {
                    return;
                }
                
                e.preventDefault();
                
                textoMensaje.innerText = form.getAttribute('data-mensaje') || '¿Seguro que quieres realizar esta acción?';
                
                accionPendiente = function() {
                    form.dataset.confirmado = 'true';
                    form.submit();
                };
                
                bsConfirmModal.show();
            });
        });

        // Botones de eliminación directa
        const botonesEliminar = document.querySelectorAll('.js-delete-btn');
        botonesEliminar.forEach(btn => {
            btn.addEventListener('click', function() {
                const urlDestino = btn.getAttribute('data-url');
                
                textoMensaje.innerText = btn.getAttribute('data-mensaje') || '¿Seguro que quieres realizar esta acción?';
                
                accionPendiente = function() {
                    window.location.href = urlDestino;
                };
                
                bsConfirmModal.show();
            });
        });

        // Al confirmar la acción en el modal
        btnAceptar.addEventListener('click', function() {
            if (accionPendiente) {
                accionPendiente();
            }
            bsConfirmModal.hide();
        });
    }
});

// ==========================================
// 3. CONTROLADOR DE PANTALLA DE CARGA (HYPRLAND LOADER)
// ==========================================
window.addEventListener("load", function() {
    const loader = document.getElementById('hypr-loader');
    if (loader) {
        // Delay de 1.2s para que se alcance a renderizar la animación del prompt TUI
        setTimeout(function() {
            loader.classList.add('fade-out');
            document.body.classList.remove('loader-active');
        }, 1200);
    }
});