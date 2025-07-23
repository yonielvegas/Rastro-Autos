<?php
include 'navbar.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
// Datos de ejemplo del carrito (en un caso real esto vendría de la base de datos)
$productos_carrito = [
    [
        'id' => 1,
        'nombre' => 'Filtro de Aceite Premium',
        'imagen' => 'https://via.placeholder.com/80',
        'precio' => 24.99,
        'cantidad' => 2,
        'subtotal' => 49.98
    ],
    [
        'id' => 2,
        'nombre' => 'Pastillas de Freno Delanteras',
        'imagen' => 'https://via.placeholder.com/80',
        'precio' => 35.50,
        'cantidad' => 1,
        'subtotal' => 35.50
    ],
    [
        'id' => 3,
        'nombre' => 'Bujías de Iridio',
        'imagen' => 'https://via.placeholder.com/80',
        'precio' => 12.99,
        'cantidad' => 4,
        'subtotal' => 51.96
    ]
];

$total = array_sum(array_column($productos_carrito, 'subtotal'));

// Calcular impuesto 7%
$impuesto = $total * 0.07;

// Total final con impuesto incluido
$total_con_impuesto = $total + $impuesto;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Carrito - PARTSPRO</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloCarrito.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <main class="cart-container">
    <h1 class="cart-title"><i class="fas fa-shopping-cart"></i> Tu Carrito de Compras</h1>
    
    <?php if (count($productos_carrito) > 0): ?>
      <div class="cart-grid">
        <div class="cart-items">
          <?php foreach ($productos_carrito as $producto): ?>
            <div class="cart-item">
              <img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>" class="cart-item-img">
              <div class="cart-item-details">
                <h3 class="cart-item-name"><?= $producto['nombre'] ?></h3>
                <p class="cart-item-price">$<?= number_format($producto['precio'], 2) ?></p>
                <div class="cart-item-actions">
                  <div class="quantity-control">
                    <button class="quantity-btn">-</button>
                    <span class="quantity-value"><?= $producto['cantidad'] ?></span>
                    <button class="quantity-btn">+</button>
                  </div>
                  <button class="remove-btn" data-id="<?= $producto['id_parte'] ?>">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </button>
                </div>
                <div class="cart-item-subtotal">
                  Subtotal: $<?= number_format($producto['precio'] * $producto['cantidad'], 2) ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="cart-summary">
          <h3 class="summary-title">Resumen del Pedido</h3>
          <div class="summary-row">
            <span>Subtotal</span>
            <span>$<?= number_format($total, 2) ?></span>
          </div>
          <div class="summary-row">
            <span>Impuesto (7%)</span>
            <span>$<?= number_format($impuesto, 2) ?></span>
          </div>
          <div class="summary-row summary-total">
            <span>Total</span>
            <span>$<?= number_format($total_con_impuesto, 2) ?></span>
          </div>
          <button class="checkout-btn">
            <i class="fas fa-credit-card"></i> Proceder al Pago
          </button>
        </div>
      </div>
    <?php else: ?>
      <div class="empty-cart">
        <div class="empty-cart-icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <h3 class="empty-cart-message">Tu carrito está vacío</h3>
        <a href="catalogo.php" class="continue-shopping">
          <i class="fas fa-arrow-left"></i> Continuar comprando
        </a>
      </div>
    <?php endif; ?>
  </main>

  <?php include('footer.php'); ?>

  <script>
    document.querySelectorAll('.remove-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const id_parte = this.dataset.id;

        Swal.fire({
          title: '¿Eliminar producto?',
          text: 'Esta acción no se puede deshacer.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e11d48',
          cancelButtonColor: '#3b82f6',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch('eliminar_carrito.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: `id_parte=${id_parte}`
            })
            .then(res => res.json())
            .then(data => {
              if (data.ok) {
                Swal.fire({
                  title: 'Eliminado',
                  text: 'Producto eliminado del carrito.',
                  icon: 'success',
                  timer: 1500,
                  showConfirmButton: false
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire('Error', data.msg || 'Error al eliminar el producto', 'error');
              }
            });
          }
        });
      });
    });
  </script>

</body>
</html>
