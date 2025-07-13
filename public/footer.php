<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>PARTSPRO</h3>
                <p class="footer-text">Proveedores de autopartes premium con los más altos estándares de calidad.</p>
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
    *, *::before, *::after {
        box-sizing: border-box;
    }

    .main-footer {
        width: 100%;
        background-color: #1e293b;
        color: white;
        padding: 2rem 1rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
    }

    .footer-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
    }

    .footer-column h3 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .footer-text {
        font-size: 0.8rem;
        color: #cbd5e1;
        margin: 0;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-link {
        margin-bottom: 0.4rem;
        font-size: 0.8rem;
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
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #334155;
        color: #94a3b8;
        font-size: 0.75rem;
    }

    @media (max-width: 600px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }

        .main-footer {
            padding: 1.5rem 1rem;
        }

        .footer-column h3 {
            font-size: 0.95rem;
        }

        .footer-text, .footer-link {
            font-size: 0.75rem;
        }
    }
</style>

<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>
