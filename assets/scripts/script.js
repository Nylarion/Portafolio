document.addEventListener("DOMContentLoaded", function() {

    // ==========================================
    // 1. SISTEMA DE NAVEGACIÓN DE LA BARRA LATERAL
    // ==========================================
    const sidebarLinks = document.querySelectorAll(".sidebar-links .nav-link");
    const dashboardSections = document.querySelectorAll(".dashboard-section");

    sidebarLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            sidebarLinks.forEach(item => item.classList.remove("active"));
            this.classList.add("active");

            dashboardSections.forEach(section => section.classList.remove("active"));

            const targetId = this.getAttribute("href");
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                targetSection.classList.add("active");
            }
        });
    });


    // ==========================================
    // 2. SISTEMA DE MODALES DE CONFIRMACIÓN
    // ==========================================
    const modalEl = document.getElementById('modalConfirmacionGlobal');
    

    if (modalEl) {
        const bsConfirmModal = new bootstrap.Modal(modalEl);
        const textoMensaje = document.getElementById('textoMensajeConfirmacion');
        const btnAceptar = document.getElementById('btnAceptarConfirmacion');
        let accionPendiente = null;


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


        btnAceptar.addEventListener('click', function() {
            if (accionPendiente) {
                accionPendiente();
            }
            bsConfirmModal.hide();
        });
    }
});

// ==========================================
// 3. CONTROLADOR DE PANTALLA DE CARGA
// ==========================================
window.addEventListener("load", function() {
    const loader = document.getElementById('hypr-loader');
    if (loader) {

        setTimeout(function() {
            loader.classList.add('fade-out');
            document.body.classList.remove('loader-active');
        }, 1200);
    }
});
