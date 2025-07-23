<?php 
include('navbar.php'); 
require_once('../clases/logger.php');
require_once('../clases/conexion.php');

logger::info("id de usuario detalles partes: " . ($_SESSION['id_usuario'] ?? 'No autenticado'));

if (!isset($_GET['id'])) {
    echo "<script>alert('Parte no especificada.'); window.history.back();</script>";
    exit;
}

$id_parte = intval($_GET['id']);
$db = new mod_db();
$detalles = $db->obtenerProducto($id_parte);

if (!$detalles) {
    echo "<script>alert('Producto no encontrado.'); window.history.back();</script>";
    exit;
}

$stock = intval($detalles['cantidad_stock'] ?? 0);

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
    .stock-high { background-color: #10b981; }
    .stock-medium { background-color: #ffb700; }
    .stock-low { background-color: #ff6a00; }
    .stock-out { background-color: #e20404; }
  </style>
</head>
<body>

<main class="container">
  <section class="detail-hero">
    <div class="detail-hero-content">
      <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i> Volver</a>
      <h1 class="detail-title"><?= htmlspecialchars($detalles['nombre']) ?></h1>
    </div>
  </section>

  <div class="detail-content">
    <div class="detail-gallery">
      <img src="<?= htmlspecialchars($detalles['imagen'] ?? 'https://via.placeholder.com/800') ?>" alt="<?= htmlspecialchars($detalles['nombre']) ?>" class="main-image" id="mainImage" />
    </div>

    <div class="detail-info">
      <div class="detail-price">$<?= number_format($detalles['precio'], 2) ?></div>
      <div class="detail-meta">
        <span class="stock-badge" id="stockBadge">
          <?= $stock > 0 ? "En stock ($stock unidades)" : "Sin stock disponible" ?>
        </span>
      </div>

      <p class="detail-description"><?= nl2br(htmlspecialchars($detalles['descripcion'] ?? '')) ?></p>

      <h3 class="specs-title">Especificaciones</h3>
      <div class="specs-grid">
        <?php 
        $especificaciones = [
          'Parte' => $detalles['nombre'] ?? '',
          'Marca' => $detalles['marca'] ?? '',
          'Modelo' => $detalles['modelo'] ?? '',
          'Año' => $detalles['anio'] ?? '',
          'Categoría' => $detalles['categoria'] ?? '',
          'Código de Serie' => $detalles['codigo_serie'] ?? ''
        ];
        $iconos = [
          'Parte' => 'fas fa-cog',
          'Marca' => 'fas fa-industry',
          'Modelo' => 'fas fa-car-side',
          'Año' => 'fas fa-calendar-alt',
          'Categoría' => 'fas fa-tags',
          'Código de Serie' => 'fas fa-barcode'
        ];
        foreach ($especificaciones as $label => $valor):
        ?>
          <div class="spec-item">
            <div class="spec-icon"><i class="<?= $iconos[$label] ?>"></i></div>
            <div>
              <div class="spec-label"><?= $label ?></div>
              <div class="spec-value"><?= htmlspecialchars($valor) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <?php if (($_SESSION['autenticado'] ?? '') === 'SI'): ?>
      <div class="quantity-controls">
        <div class="quantity-selector">
          <button class="quantity-btn minus-btn" onclick="decrementQuantity()"><i class="fas fa-minus"></i></button>
          <input type="number" id="cantidadProducto" class="quantity-input" min="0" max="<?= $stock ?>" value="1" onchange="validateQuantity()" />
          <button class="quantity-btn plus-btn" onclick="incrementQuantity()"><i class="fas fa-plus"></i></button>
        </div>

        <button class="btn btn-primary" id="addToCartBtn"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
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
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(tabName).classList.add('active');
    evt.currentTarget.classList.add('active');
  }
  document.addEventListener('DOMContentLoaded', () => document.querySelector('.tab-btn').click());

  // Stock badge update
  function actualizarEstadoStock() {
    const stockBadge = document.getElementById('stockBadge');
    const cantidadInput = document.getElementById('cantidadProducto');
    if (!stockBadge || !cantidadInput) return;

    const maxStock = parseInt(cantidadInput.max);
    stockBadge.classList.remove('stock-high', 'stock-medium', 'stock-low', 'stock-out');

    if (maxStock > 10) {
      stockBadge.textContent = `En stock (${maxStock} unidades)`;
      stockBadge.classList.add('stock-high');
    } else if (maxStock >= 6) {
      stockBadge.textContent = `Stock bajo (${maxStock} unidades)`;
      stockBadge.classList.add('stock-medium');
    } else if (maxStock >= 1) {
      stockBadge.textContent = `Últimas piezas (${maxStock} unidades)`;
      stockBadge.classList.add('stock-low');
    } else {
      stockBadge.textContent = 'Agotado';
      stockBadge.classList.add('stock-out');
    }

    cantidadInput.disabled = maxStock === 0;
    const addBtn = document.getElementById('addToCartBtn');
    if (addBtn) addBtn.disabled = maxStock === 0;
  }
  document.addEventListener('DOMContentLoaded', actualizarEstadoStock);

  // Cantidad controls
  function incrementQuantity() {
    const input = document.getElementById('cantidadProducto');
    if (parseInt(input.value) < parseInt(input.max)) input.value = parseInt(input.value) + 1;
  }
  function decrementQuantity() {
    const input = document.getElementById('cantidadProducto');
    if (parseInt(input.value) > parseInt(input.min)) input.value = parseInt(input.value) - 1;
  }
  function validateQuantity() {
    const input = document.getElementById('cantidadProducto');
    let val = parseInt(input.value);
    if (isNaN(val) || val < parseInt(input.min)) input.value = input.min;
    else if (val > parseInt(input.max)) input.value = input.max;
  }

  // Función para actualizar el contador del carrito en el navbar
  async function actualizarContadorCarrito() {
    try {
      const response = await fetch('../controller_public/contar_carrito.php');
      const data = await response.json();
      const contador = document.querySelector('.cart-count');
      if (contador && data.total !== undefined) {
        contador.textContent = data.total;
      }
    } catch (error) {
      console.error('Error al actualizar contador del carrito:', error);
    }
  }

  // Añadir al carrito
  document.getElementById('addToCartBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    const id_parte = <?= intval($detalles['id_parte']) ?>;
    const cantidad = parseInt(document.getElementById('cantidadProducto').value);

    fetch('../controller_public/agregar_carrito.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id_parte=${id_parte}&cantidad=${cantidad}`
    })
    .then(res => res.json())
    .then(data => {
      if(data.ok){
        this.innerHTML = '<i class="fas fa-check"></i> Añadido';
        this.style.backgroundColor = '#10b981';

        // Actualizar contador del carrito aquí
        actualizarContadorCarrito();
      } else {
        alert(data.msg);
      }
      setTimeout(() => {
        this.innerHTML = '<i class="fas fa-shopping-cart"></i> Añadir al carrito';
        this.style.backgroundColor = '#3b82f6';
      }, 2000);
    });
  });

</script>

<?php include('footer.php'); ?>
</body>
</html>
