<?php include '../comunes/navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Secciones Automotrices</title>
  <link rel="stylesheet" href="../estilos/estiloSeccion.css" />
</head>
<body>
  <?php include '../comunes/sidebar.php'; ?>
  <div class="main-content" id="mainContent" style="padding-top: 100px;">
    <div class="container">
      <h1>Secciones</h1>

      <div class="categories">
        <div class="category-row">
          <a href="seccionEspecifica.php?seccion=1" class="category-card">
            <img src="../imagenes/carroceria.jpg" alt="Carrocería" />
            <h2>Carrocería</h2>
          </a>
          <a href="seccionEspecifica.php?seccion=2" class="category-card">
            <img src="../imagenes/motor.png" alt="Motor" />
            <h2>Motor</h2>
          </a>
          <a href="seccionEspecifica.php?seccion=3" class="category-card">
            <img src="../imagenes/puertas.jpg" alt="Puertas" />
            <h2>Puertas</h2>
          </a>
        </div>

        <div class="category-row">
          <a href="seccionEspecifica.php?seccion=4" class="category-card">
            <img src="../imagenes/vidrios.jpeg" alt="Vidrios" />
            <h2>Vidrios</h2>
          </a>
          <a href="seccionEspecifica.php?seccion=5" class="category-card">
            <img src="../imagenes/espejos.jpg" alt="Espejos" />
            <h2>Espejos</h2>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
