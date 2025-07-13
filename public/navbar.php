<header class="main-header">
    <div class="header-container">
        <div class="header-content">
            <a href="index.html" class="logo">PARTSPRO</a>
            <nav class="nav-links">
                <a href="catalogo.html" class="nav-link">Catálogo</a>
                <a href="como-comprar.html" class="nav-link">Cómo comprar</a>
                <a href="garantias.html" class="nav-link">Garantías</a>
                <a href="contacto.html" class="nav-link">Contacto</a>
            </nav>
        </div>
    </div>
</header>

<style>
    /* Box-sizing global para evitar overflow con padding/margin */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
    }

    .main-header {
        width: 100%;
        padding: 0 1.5rem;
        background-color: white;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1),
                    0 2px 4px -1px rgba(0,0,0,0.06);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .header-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 0;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2563eb;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
    }

    .nav-links {
        display: flex;
        gap: 2rem;
    }

    .nav-link {
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
        font-family: 'Inter', sans-serif;
    }

    .nav-link:hover {
        color: #2563eb;
    }

    @media (max-width: 768px) {
        .main-header {
            padding: 0 1rem;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
            padding: 1rem 0;
        }

        .nav-links {
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>
