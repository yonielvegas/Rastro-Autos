<?php include('navbar.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Selecciona tu Auto</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../estilos/estiloCatalogo.css" />
</head>
<body>
  <div class="container">
    <h1>Selecciona tu Auto</h1>
    
    <!-- Logos de marcas -->
    <div class="brands-container">
      <img src="https://images.seeklogo.com/logo-png/17/2/toyota-logo-png_seeklogo-171947.png" alt="Toyota" class="brand-logo active" data-brand="toyota" />
      <img src="https://images.seeklogo.com/logo-png/8/2/mazda-logo-png_seeklogo-89737.png" alt="Mazda" class="brand-logo" data-brand="mazda" />
      <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Ford_logo_flat.svg" alt="Ford" class="brand-logo" data-brand="ford" />
    </div>
    
    <!-- Modelos Toyota -->
    <div id="toyota-models" class="models-container active">
      <h2 class="brand-title">Toyota</h2>
      <div class="models-grid">
        <div class="model-card">
          <img src="../imagenes/corolla2023.png" alt="Toyota Corolla" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">Corolla</h3>
            <p class="model-year">2023</p>
            <a href="modelos.php?marca=toyota&modelo=corolla" class="select-btn">Seleccionar</a>
          </div>
        </div>
        
        <div class="model-card">
          <img src="../imagenes/rav42022.jpg" alt="Toyota RAV4" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">RAV4</h3>
            <p class="model-year">2022</p>
            <a href="modelos.php?marca=toyota&modelo=rav4" class="select-btn">Seleccionar</a>
          </div>
        </div>
        
        <div class="model-card">
          <img src="../imagenes/prado2011.png" alt="Toyota Prado" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">Prado</h3>
            <p class="model-year">2011</p>
            <a href="modelos.php?marca=toyota&modelo=prado" class="select-btn">Seleccionar</a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modelos Mazda -->
    <div id="mazda-models" class="models-container">
      <h2 class="brand-title">Mazda</h2>
      <div class="models-grid">
        <div class="model-card">
          <img src="../imagenes/mazda2011.png" alt="Mazda CX-5" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">CX-5</h3>
            <p class="model-year">2011</p>
            <a href="modelos.php?marca=mazda&modelo=cx-5" class="select-btn">Seleccionar</a>
          </div>
        </div>
        
        <div class="model-card">
          <img src="../imagenes/miata2016.png" alt="Mazda MX-5 Miata" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">MX-5 Miata</h3>
            <p class="model-year">2016</p>
            <a href="modelos.php?marca=mazda&modelo=mx-5-miata" class="select-btn">Seleccionar</a>
          </div>
        </div>
        
        <div class="model-card">
          <img src="../imagenes/mazda2022.jpg" alt="Mazda CX-30" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">CX-30</h3>
            <p class="model-year">2022</p>
            <a href="modelos.php?marca=mazda&modelo=cx-30" class="select-btn">Seleccionar</a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modelos Ford -->
    <div id="ford-models" class="models-container">
      <h2 class="brand-title">Ford</h2>
      <div class="models-grid">
        <div class="model-card">
          <img src="../imagenes/mustang2005.png" alt="Ford Mustang" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">Mustang</h3>
            <p class="model-year">2005</p>
            <a href="modelos.php?marca=ford&modelo=mustang" class="select-btn">Seleccionar</a>
          </div>
        </div>
        
        <div class="model-card">
          <img src="../imagenes/escape2012.png" alt="Ford Escape" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">Escape</h3>
            <p class="model-year">2012</p>
            <a href="modelos.php?marca=ford&modelo=escape" class="select-btn">Seleccionar</a>
          </div>
        </div>
        
        <div class="model-card">
          <img src="../imagenes/ford2010.jpg" alt="Ford F-150" class="model-image" />
          <div class="model-info">
            <h3 class="model-name">F-150</h3>
            <p class="model-year">2010</p>
            <a href="modelos.php?marca=ford&modelo=f-150" class="select-btn">Seleccionar</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const brandLogos = document.querySelectorAll('.brand-logo');
      const modelsContainers = document.querySelectorAll('.models-container');

      brandLogos.forEach(logo => {
        logo.addEventListener('click', function() {
          const brand = this.dataset.brand;

          // Actualizar logos activos
          brandLogos.forEach(l => l.classList.remove('active'));
          this.classList.add('active');

          // Mostrar solo modelos de marca seleccionada
          modelsContainers.forEach(container => {
            container.classList.remove('active');
          });

          document.getElementById(`${brand}-models`).classList.add('active');
        });
      });
    });
  </script>

<?php include('footer.php'); ?>
</body>
</html>
