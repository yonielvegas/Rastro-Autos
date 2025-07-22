<?php 
include('navbar.php'); 

// Aquí defines la cantidad real de stock (puede venir de base de datos)
$stockCantidad = 7; // Ejemplo: cambia a 3, 8, 12 o 0 para probar
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalles de Parte | Rastro de Partes de Autos</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloDetalles.css" />
  <style>
    /* para el stock */
    .stock-badge {
      color: white;
      padding: 0.25rem 0.75rem;
      border-radius: 1rem;
      font-weight: 600;
      font-size: 20px;
      display: inline-block;
    }

    /* Colores específicos */
    .stock-high {
      background-color: #10b981; /* verde */
    }

    .stock-medium {
      background-color: #ffb700ff; /* amarillo */
    }

    .stock-low {
      background-color: #ff6a00ff; /* naranja */
    }

    .stock-out {
      background-color: #e20404ff; /* rojo */
    }
  </style>
</head>
<body>

<main class="container">
  <section class="detail-hero">
    <div class="detail-hero-content">
      <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
      <h1 class="detail-title">Alternador Premium Toyota Corolla</h1>
    </div>
  </section>

  <div class="detail-content">
    <div class="detail-gallery">
      <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Alternador Toyota Corolla" class="main-image" id="mainImage" />
    </div>

    <div class="detail-info">
      <div class="detail-price">$289.99</div>
      <div class="detail-meta">
        <span class="stock-badge" id="stockBadge">En stock (<?php echo $stockCantidad; ?> unidades)</span>
      </div>

      <p class="detail-description">
        Panel lateral diseñado específicamente para vehículos Ford modelo F-150 del año 2010. Forma parte de la categoría 'Carroceria' y ha sido fabricado con vidrio templado de alta calidad. Presenta un acabado liso en color azul oscuro, que asegura no solo resistencia y durabilidad, sino también una integración estética con el diseño original del vehículo. Ideal para reparaciones, mejoras o restauraciones completas, manteniendo el rendimiento y la apariencia del auto en condiciones óptimas.
      </p>

      <h3 class="specs-title">Especificaciones</h3>
      <div class="specs-grid">
        <div class="spec-item">
          <div class="spec-icon"><i class="fas fa-cog"></i></div>
          <div>
            <div class="spec-label">Parte</div>
            <div class="spec-value">Alternador</div>
          </div>
        </div>
        <div class="spec-item">
          <div class="spec-icon"><i class="fas fa-industry"></i></div>
          <div>
            <div class="spec-label">Marca</div>
            <div class="spec-value">Toyota</div>
          </div>
        </div>
        <div class="spec-item">
          <div class="spec-icon"><i class="fas fa-car-side"></i></div>
          <div>
            <div class="spec-label">Modelo</div>
            <div class="spec-value">Corolla</div>
          </div>
        </div>
        <div class="spec-item">
          <div class="spec-icon"><i class="fas fa-calendar-alt"></i></div>
          <div>
            <div class="spec-label">Año</div>
            <div class="spec-value">2018</div>
          </div>
        </div>
        <div class="spec-item">
          <div class="spec-icon"><i class="fas fa-tags"></i></div>
          <div>
            <div class="spec-label">Categoría</div>
            <div class="spec-value">Motor</div>
          </div>
        </div>
        <div class="spec-item">
          <div class="spec-icon"><i class="fas fa-barcode"></i></div>
          <div>
            <div class="spec-label">Código de Serie</div>
            <div class="spec-value">ALT-TY-COR18-002</div>
          </div>
        </div>
      </div>

      <?php if (isset($_SESSION['usuario'])): ?>
      <div class="quantity-controls">
        <div class="quantity-selector">
          <button class="quantity-btn minus-btn" onclick="decrementQuantity()">
            <i class="fas fa-minus"></i>
          </button>
          <input 
            type="number" 
            id="cantidadProducto" 
            class="quantity-input" 
            min="1" 
            max="<?php echo $stockCantidad; ?>" 
            value="1" 
            onchange="validateQuantity()" 
          />
          <button class="quantity-btn plus-btn" onclick="incrementQuantity()">
            <i class="fas fa-plus"></i>
          </button>
        </div>

        <button class="btn btn-primary" id="addToCartBtn">
          <i class="fas fa-shopping-cart"></i> Añadir al carrito
        </button>
      </div>
      <?php endif; ?>

    </div>
  </div>

  <div class="detail-tabs">
    <div class="tabs-header">
      <button class="tab-btn" onclick="openTab(event, 'shipping')">Envío y Devoluciones</button>
    </div>
    <div id="shipping" class="tab-content">
      <h3>Envío y Devoluciones</h3>
      <h4>Opciones de envío:</h4>
      <ul>
        <li><strong>Estándar:</strong> 3-5 días hábiles - $5.99</li>
        <li><strong>Express:</strong> 1-2 días hábiles - $12.99</li>
        <li><strong>Recogida en tienda:</strong> Gratis - Disponible en 24 horas</li>
      </ul>

      <h4>Política de devoluciones:</h4>
      <p>Aceptamos devoluciones dentro de los 30 días posteriores a la compra. El producto debe estar en su empaque original y sin usar. Los gastos de envío de devolución corren por cuenta del cliente, excepto en casos de productos defectuosos.</p>
    </div>
  </div>
</main>

<script>
  // Tabs
  function openTab(evt, tabName) {
    const tabContents = document.querySelectorAll('.tab-content');
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabContents.forEach(content => content.classList.remove('active'));
    tabButtons.forEach(button => button.classList.remove('active'));
    document.getElementById(tabName).classList.add('active');
    evt.currentTarget.classList.add('active');
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.tab-btn').click();
  });

  // Función para actualizar texto y estilo según stock
  function actualizarEstadoStock() {
    const stockBadge = document.getElementById('stockBadge');
    const cantidadInput = document.getElementById('cantidadProducto');
    if (!stockBadge || !cantidadInput) return;

    const maxStock = parseInt(cantidadInput.max);

    stockBadge.classList.remove('stock-high', 'stock-medium', 'stock-low', 'stock-out');

    if (maxStock > 10) {
      stockBadge.textContent = `En stock (${maxStock} unidades)`;
      stockBadge.classList.add('stock-high');
    } else if (maxStock >= 6 && maxStock <= 10) {
      stockBadge.textContent = `Stock bajo (${maxStock} unidades)`;
      stockBadge.classList.add('stock-medium');
    } else if (maxStock >= 1 && maxStock <= 5) {
      stockBadge.textContent = `Últimas piezas (${maxStock} unidades)`;
      stockBadge.classList.add('stock-low');
    } else {
      stockBadge.textContent = 'Agotado';
      stockBadge.classList.add('stock-out');
    }

    // Deshabilita input y botón si no hay stock
    cantidadInput.disabled = maxStock === 0;
    const addBtn = document.getElementById('addToCartBtn');
    if (addBtn) addBtn.disabled = maxStock === 0;
  }

  document.addEventListener('DOMContentLoaded', () => {
    actualizarEstadoStock();
  });

  // Cantidad: increment, decrement y validación
  function incrementQuantity() {
    const input = document.getElementById('cantidadProducto');
    if (parseInt(input.value) < parseInt(input.max)) {
      input.value = parseInt(input.value) + 1;
    }
  }

  function decrementQuantity() {
    const input = document.getElementById('cantidadProducto');
    if (parseInt(input.value) > parseInt(input.min)) {
      input.value = parseInt(input.value) - 1;
    }
  }

  function validateQuantity() {
    const input = document.getElementById('cantidadProducto');
    let value = parseInt(input.value);
    if (isNaN(value) || value < parseInt(input.min)) {
      input.value = input.min;
    } else if (value > parseInt(input.max)) {
      input.value = input.max;
    }
  }

  // Animación botón Añadir al carrito
  document.getElementById('addToCartBtn')?.addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-check"></i> Añadido';
    this.style.backgroundColor = '#10b981';

    setTimeout(() => {
      this.innerHTML = '<i class="fas fa-shopping-cart"></i> Añadir al carrito';
      this.style.backgroundColor = '#3b82f6';
    }, 2000);
  });
</script>

<?php include('footer.php'); ?>
</body>
</html>
