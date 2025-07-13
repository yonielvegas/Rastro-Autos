<?php include('navbar.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rastro de Partes de Autos | Premium</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #475569;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #e2e8f0;
            --success: #10b981;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            --elevation-md: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 5rem 1.5rem;
            border-radius: 0 0 1rem 1rem;
            text-align: center;
            position: relative;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* Search */
        .search-container {
            margin: 3rem auto 2rem;
            text-align: center;
        }

        .search-bar {
            display: flex;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: var(--card-shadow);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .search-input {
            flex: 1;
            padding: 1rem;
            border: none;
            font-size: 1rem;
            outline: none;
        }

        .search-button {
            background-color: var(--dark);
            padding: 0 1.5rem;
            border: none;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-button:hover {
            background-color: #1e293b;
        }

        /* Filters */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .filter-chip {
            background: white;
            border: 1px solid var(--gray);
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            border-radius: 20px;
            color: var(--secondary);
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-chip:hover {
            background-color: var(--gray);
        }

        .filter-chip.active {
            background-color: var(--primary);
            color: white;
        }

        /* Section Title */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        /* Grid */
        .parts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding-bottom: 4rem;
        }

        /* Card */
        .part-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .part-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--elevation-md);
        }

        .part-image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .part-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .part-card:hover .part-image {
            transform: scale(1.05);
        }

        .part-content {
            padding: 1.5rem;
        }

        .part-title {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .part-description {
            font-size: 0.9rem;
            color: var(--secondary);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Limita a 2 líneas */
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0; /* elimina margen inferior */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            .section-title {
                font-size: 1.5rem;
            }
            .part-title {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Partes Premium para tu Automóvil</h1>
                <p class="hero-subtitle">Encuentra las piezas originales y de alta calidad que necesitas para mantener tu vehículo en perfecto estado.</p>
            </div>
        </section>

        <div class="search-container">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Buscar por número de parte, marca o modelo..." />
                <button class="search-button" aria-label="Buscar">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </div>
        </div>

        <div class="filters">
            <div class="filter-chip active">Todos</div>
            <div class="filter-chip">Motor</div>
            <div class="filter-chip">Transmisión</div>
            <div class="filter-chip">Suspensión</div>
            <div class="filter-chip">Frenos</div>
            <div class="filter-chip">Carrocería</div>
            <div class="filter-chip">Interior</div>
            <div class="filter-chip">Eléctrico</div>
            <div class="filter-chip">Rines</div>
            <div class="filter-chip">Accesorios</div>
        </div>

        <h2 class="section-title">Partes Destacadas</h2>
        <div class="parts-grid">
            <!-- Part 1 -->
            <div class="part-card">
                <div class="part-image-container">
                    <img
                        src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Alternador"
                        class="part-image"
                    />
                </div>
                <div class="part-content">
                    <h3 class="part-title">Alternador Toyota Corolla</h3>
                    <p class="part-description">
                        Alternador original OEM para modelos 2014-2018 con motor 1.8L. Incluye tensor y polea. 30,000 km de uso.
                    </p>
                </div>
            </div>

            <!-- Part 2 -->
            <div class="part-card">
                <div class="part-image-container">
                    <img
                        src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Parabrisas"
                        class="part-image"
                    />
                </div>
                <div class="part-content">
                    <h3 class="part-title">Parabrisas Nissan Sentra</h3>
                    <p class="part-description">
                        Parabrisas original con sellado incluido. Sin daños o rayones. Compatible con modelos 2017-2020.
                    </p>
                </div>
            </div>

            <!-- Part 3 -->
            <div class="part-card">
                <div class="part-image-container">
                    <img
                        src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Asiento"
                        class="part-image"
                    />
                </div>
                <div class="part-content">
                    <h3 class="part-title">Asiento Delantero Honda Civic</h3>
                    <p class="part-description">
                        Asiento eléctrico con ajuste lumbar en piel. Color negro. Compatible con modelos 2016-2019.
                    </p>
                </div>
            </div>

            <!-- Part 4 -->
            <div class="part-card">
                <div class="part-image-container">
                    <img
                        src="https://images.unsplash.com/photo-1601758003122-53c40e686a19?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Radiador"
                        class="part-image"
                    />
                </div>
                <div class="part-content">
                    <h3 class="part-title">Radiador Volkswagen Jetta</h3>
                    <p class="part-description">
                        Radiador de aluminio para modelos 2015-2019. Sin fugas, listo para instalar. Incluye tapón.
                    </p>
                </div>
            </div>

            <!-- Part 5 -->
            <div class="part-card">
                <div class="part-image-container">
                    <img
                        src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Llanta"
                        class="part-image"
                    />
                </div>
                <div class="part-content">
                    <h3 class="part-title">Llanta con Rin Mazda 3</h3>
                    <p class="part-description">
                        Llanta 225/45R18 con 80% de vida útil. Rin original de aleación sin daños. Color plata.
                    </p>
                </div>
            </div>

            <!-- Part 6 -->
            <div class="part-card">
                <div class="part-image-container">
                    <img
                        src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Faro"
                        class="part-image"
                    />
                </div>
                <div class="part-content">
                    <h3 class="part-title">Faro Delantero Chevrolet Aveo</h3>
                    <p class="part-description">
                        Faro derecho original para modelos 2013-2016. Lente en perfecto estado, incluye bombillas.
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
<?php include('footer.php'); ?>
</html>
