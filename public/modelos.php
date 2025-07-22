<?php 
  include('navbar.php');
  include('../clases/conexion.php');

  if (isset($_GET['marca']) && isset($_GET['modelo'])) {
    $marca = htmlspecialchars($_GET['marca']);
    $modelo = htmlspecialchars($_GET['modelo']);
  } else {
    echo "<script>alert('Marca y modelo no especificados.');</script>";
    exit;
  }

  $db = new mod_db();
  $partes = $db->partes($marca, $modelo);
  $total_productos = $partes['total'] ?? 0;

  // --- Paginación ---
  $cantidades = [8, 12, 16, 'todos'];
  $por_pagina = isset($_GET['por_pagina']) && in_array($_GET['por_pagina'], ['8','12','16','todos']) ? $_GET['por_pagina'] : 8;
  $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;

  if ($por_pagina === 'todos') {
    $por_pagina_val = $total_productos > 0 ? $total_productos : 1;
    $total_paginas = 1;
    $offset = 0;
  } else {
    $por_pagina_val = intval($por_pagina);
    $total_paginas = $por_pagina_val > 0 ? ceil($total_productos / $por_pagina_val) : 1;
    $offset = ($pagina - 1) * $por_pagina_val;
  }

  // Obtener partes de la página actual
  if ($por_pagina === 'todos') {
    $partes_pagina = $db->partes($marca, $modelo);
  } else {
    $partes_pagina = $db->partes($marca, $modelo, $offset, $por_pagina_val);
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Partes del Vehículo</title>
  <link rel="stylesheet" href="../estilos/estiloModelo.css" />
  <style>
    .pagination { margin: 2rem 0; text-align: center; }
    .pagination a, .pagination span {
      display: inline-block; padding: 8px 14px; margin: 0 2px; border-radius: 4px;
      background: #f1f5f9; color: #2563eb; text-decoration: none; font-weight: 500;
    }
    .pagination a.active, .pagination span.active { background: #2563eb; color: #fff; }
    .pagination a.disabled { pointer-events: none; color: #aaa; }
    .per-page-links { text-align: right; margin: 1rem 0; }
    .per-page-links a, .per-page-links span {
      margin-left: 8px; color: #2563eb; text-decoration: underline; cursor: pointer;
    }
    .per-page-links span.selected {
      font-weight: bold; color: #fff; background: #2563eb; padding: 2px 8px; border-radius: 4px; text-decoration: none;
    }
  </style>
</head>
<body>
  <main class="container">
    <section class="hero">
      <div class="hero-content">
        <h1 class="hero-title">Partes para Toyota Corolla 2023</h1>
        <p class="hero-subtitle">Explora las piezas disponibles para tu modelo.</p>
      </div>
    </section>


    <!-- Barra de búsqueda -->
    <div class="search-container">
      <div class="search-bar">
        <input type="text" class="search-input" placeholder="Buscar por nombre, categoría o descripción..." />
        <button class="search-button" aria-label="Buscar">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>

    <!-- Filtros de categoría -->
    <div class="filters">
      <div class="filter-chip active" data-categoria="todos">Todos</div>
      <div class="filter-chip" data-categoria="carroceria">Carrocería</div>
      <div class="filter-chip" data-categoria="puertas">Puertas</div>
      <div class="filter-chip" data-categoria="motor">Motor</div>
      <div class="filter-chip" data-categoria="espejos">Espejos</div>
      <div class="filter-chip" data-categoria="vidrios">Vidrios</div>
    </div>


    <!-- Selector de cantidad por página como enlaces -->
    <div class="per-page-links">
      Cantidad:
      <?php foreach ($cantidades as $cant): ?>
        <?php
          $is_selected = ($por_pagina == $cant);
          $url = "?marca=" . urlencode($marca) . "&modelo=" . urlencode($modelo) . "&por_pagina=$cant";
          if ($cant !== 'todos' && $pagina > 1) $url .= "&pagina=1";
        ?>
        <?php if ($is_selected): ?>
          <span class="selected"><?= $cant === 'todos' ? 'Todos' : $cant ?></span>
        <?php else: ?>
          <a href="<?= $url ?>"><?= $cant === 'todos' ? 'Todos' : $cant ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Partes del auto -->
    <div class="parts-grid">
      <?php foreach ($partes_pagina as $parte): ?>
        <?php if (!is_array($parte)) continue; ?>
        <div class="part-card" data-categoria="<?= strtolower($parte['categoria'] ?? 'otros') ?>">
          <div class="part-image-container">
            <img src="../imagenes/<?= htmlspecialchars($parte['imagen'] ?? 'sin-imagen.jpg') ?>"
                 alt="<?= htmlspecialchars($parte['nombre'] ?? 'Sin nombre') ?>" class="part-image" />
            <a href="detalle_partes.php?id=<?= $parte['id_parte'] ?? 0 ?>" class="zoom-btn" aria-label="Ver detalles">
              <i class="fas fa-search-plus"></i>
            </a>
          </div>
          <div class="part-content">
            <h3 class="part-title"><?= htmlspecialchars($parte['nombre'] ?? 'Sin nombre') ?></h3>
            <p class="part-description"><?= htmlspecialchars($parte['descripcion'] ?? '') ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Paginación -->
    <?php if ($por_pagina !== 'todos' && $total_paginas > 1): ?>
    <div class="pagination">
      <?php if ($pagina > 1): ?>
        <a href="?marca=<?= urlencode($marca) ?>&modelo=<?= urlencode($modelo) ?>&por_pagina=<?= $por_pagina ?>&pagina=<?= $pagina-1 ?>">&laquo;</a>
      <?php else: ?>
        <span class="disabled">&laquo;</span>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <?php if ($i == $pagina): ?>
          <span class="active"><?= $i ?></span>
        <?php else: ?>
          <a href="?marca=<?= urlencode($marca) ?>&modelo=<?= urlencode($modelo) ?>&por_pagina=<?= $por_pagina ?>&pagina=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($pagina < $total_paginas): ?>
        <a href="?marca=<?= urlencode($marca) ?>&modelo=<?= urlencode($modelo) ?>&por_pagina=<?= $por_pagina ?>&pagina=<?= $pagina+1 ?>">&raquo;</a>
      <?php else: ?>
        <span class="disabled">&raquo;</span>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </main>

<?php include('footer.php'); ?>


<script>
  // Filtro por categoría
  document.querySelectorAll('.filter-chip').forEach(chip => {
    chip.addEventListener('click', () => {
      document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      filtrarPartes();
    });
  });

  // Filtro por texto
  document.querySelector('.search-input').addEventListener('input', filtrarPartes);

  function filtrarPartes() {
    const categoria = document.querySelector('.filter-chip.active').dataset.categoria;
    const texto = document.querySelector('.search-input').value.toLowerCase();

    document.querySelectorAll('.part-card').forEach(card => {
      const cat = card.dataset.categoria;
      const nombre = card.querySelector('.part-title').textContent.toLowerCase();
      const desc = card.querySelector('.part-description').textContent.toLowerCase();

      const coincideCategoria = (categoria === 'todos' || cat === categoria);
      const coincideTexto = (
        nombre.includes(texto) ||
        desc.includes(texto) ||
        cat.includes(texto)
      );

      if (coincideCategoria && coincideTexto) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }
</script>

</body>
</html>