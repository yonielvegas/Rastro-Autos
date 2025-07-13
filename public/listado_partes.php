<?php include('navbar.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rastro de Partes de Autos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estiloPagina.css">
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }
        
        .pagination a {
            color: #333;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .pagination a.active {
            background-color: #2563eb;
            color: white;
            border: 1px solid #2563eb;
        }
        
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
        
        .pagination a.disabled {
            color: #aaa;
            pointer-events: none;
            border: 1px solid #ddd;
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
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>

    <div class="filters">
      <div class="filter-chip active">Todos</div>
      <div class="filter-chip">Puertas</div>
      <div class="filter-chip">Motor</div>
      <div class="filter-chip">Retrovisor</div>
      <div class="filter-chip">Vidrio</div>
    </div>

    <div class="parts-grid">
      <!-- Parte 1 -->
      <div class="part-card">
        <div class="part-image-container">
          <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Alternador" class="part-image" />
          <a href="detalle_partes.php" class="zoom-btn" aria-label="Ver detalles">
            <i class="fas fa-search-plus"></i>
          </a>
        </div>
        <div class="part-content">
          <h3 class="part-title">Alternador Toyota Corolla</h3>
          <p class="part-description">Alternador original OEM para modelos 2014-2018 con motor 1.8L.</p>
        </div>
      </div>
      
      <div class="part-card">
        <div class="part-image-container">
          <img src="https://images.unsplash.com/photo-1590856029826-c7a73142bbf1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Frenos" class="part-image" />
          <a href="detalle_partes.php" class="zoom-btn" aria-label="Ver detalles">
            <i class="fas fa-search-plus"></i>
          </a>
        </div>
        <div class="part-content">
          <h3 class="part-title">Kit de Frenos Delanteros</h3>
          <p class="part-description">Kit completo de frenos delanteros para Honda Civic 2015-2020.</p>
        </div>
      </div>
      
      <!-- Agrega más partes según sea necesario -->
    </div>

    <!-- Paginación -->
    <div class="pagination">
        <a href="#" class="disabled">&laquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">&raquo;</a>
    </div>
  </main>

<?php include('footer.php'); ?>
</body>
</html>