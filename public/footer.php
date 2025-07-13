<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>PARTSPRO</h3>
                <p>Proveedores de autopartes premium con los más altos estándares de calidad.</p>
            </div>
            <div class="footer-column">
                <h3>Enlaces</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="index.html">Inicio</a></li>
                    <li class="footer-link"><a href="catalogo.html">Catálogo</a></li>
                    <li class="footer-link"><a href="sobre-nosotros.html">Sobre nosotros</a></li>
                    <li class="footer-link"><a href="contacto.html">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Legal</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="terminos.html">Términos y condiciones</a></li>
                    <li class="footer-link"><a href="privacidad.html">Política de privacidad</a></li>
                    <li class="footer-link"><a href="garantias.html">Garantías</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contacto</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="mailto:contacto@partspro.mx">contacto@partspro.mx</a></li>
                    <li class="footer-link"><a href="tel:5512345678">Tel: 55 1234 5678</a></li>
                    <li class="footer-link">Horario: L-V 9am-6pm</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <span id="current-year"></span> PARTSPRO. Todos los derechos reservados.
        </div>
    </div>
</footer>

<style>
    /* Box-sizing global para evitar problemas de ancho */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
    }

    .main-footer {
        width: 100%;
        background-color: #1e293b;
        color: white;
        padding: 3rem 1.5rem;
        font-family: 'Inter', sans-serif;
    }

    .footer-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
    }

    .footer-column h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-link {
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .footer-link a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
    }

    .footer-link a:hover {
        color: white;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 3rem;
        padding-top: 1.5rem;
        border-top: 1px solid #334155;
        color: #94a3b8;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>

<script>
    // Año actual automático
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>
