// transitions.js
(() => {
    document.addEventListener("DOMContentLoaded", () => {

        // Al cargar completamente la página, permitir el desplazamiento
        window.addEventListener('load', () => {
            document.body.style.overflow = 'auto';
        });

        // Agregar evento click a todos los enlaces para manejar la transición de salida
        document.querySelectorAll('a').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                const href = anchor.getAttribute('href');
                if (href && !href.startsWith('#') && !anchor.hasAttribute('target')) {
                    e.preventDefault();
                    document.body.style.overflow = 'hidden';
                    document.body.classList.add('fade-out');
                    setTimeout(() => {
                        window.location.href = href;
                    }, 500); // Ajustar el tiempo según la duración de la transición CSS
                }
            });
        });
    });
})();













