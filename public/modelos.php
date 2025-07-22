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
  $partes = $db->select("partes_autos", "*", "id_marca = '$marca' AND id_modelo = '$modelo'");

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Partes del Vehículo</title>
  <link rel="stylesheet" href="../estilos/estiloModelo.css" />
  <style></style>
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

    <!-- Partes del auto -->
    <div class="parts-grid">
      <?php foreach ($partes as $parte): ?>
        <div class="part-card" data-categoria="<?= strtolower($parte['categoria'] ?? 'otros') ?>">
          <div class="part-image-container">
            <img src="../imagenes/<?= htmlspecialchars($parte['imagen'] ?? 'sin-imagen.jpg') ?>" alt="<?= htmlspecialchars($parte['nombre']) ?>" class="part-image" />
            <a href="detalle_partes.php?id=<?= $parte['id_parte'] ?>" class="zoom-btn" aria-label="Ver detalles">
              <i class="fas fa-search-plus"></i>
            </a>
          </div>
          <div class="part-content">
            <h3 class="part-title"><?= htmlspecialchars($parte['nombre']) ?></h3>
            <p class="part-description"><?= htmlspecialchars($parte['descripcion']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Paginación (estática visual) -->
    <div class="pagination">
      <a href="#" class="disabled">&laquo;</a>
      <a href="#" class="active">1</a>
      <a href="#">2</a>
      <a href="#">3</a>
      <a href="#">&raquo;</a>
    </div>
  </main>

<?php include('footer.php'); ?>

<script>
  // Filtrado visual de partes por categoría
  document.querySelectorAll('.filter-chip').forEach(chip => {
    chip.addEventListener('click', () => {
      document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
      chip.classList.add('active');

      const categoria = chip.dataset.categoria;
      document.querySelectorAll('.part-card').forEach(card => {
        card.style.display = (categoria === 'todos' || card.dataset.categoria === categoria) ? 'block' : 'none';
      });
    });
  });
</script>
</body>
</html>
