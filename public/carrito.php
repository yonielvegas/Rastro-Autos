<?php
include 'navbar.php';
require_once('../clases/conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$db = new mod_db();
$id_usuario = $_SESSION['id_usuario'] ?? null;
$productos_carrito = $db->obtenerCarrito($id_usuario);
$factura = $db->obtenerFactura($id_usuario);

$total = is_array($factura) && isset($factura[0]['total_factura']) ? $factura[0]['total_factura'] : 0;
$impuesto = $total * 0.07;
$total_con_impuesto = $total + $impuesto;
$fecha_actual = date('Y-m-d H:i');
$nombre_cliente = $_SESSION['usuario'] ?? 'Cliente Desconocido';
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
<div class="page-wrapper"><div class="main-content">
  <main class="cart-container">
    <h1 class="cart-title"><i class="fas fa-shopping-cart"></i> Tu Carrito de Compras</h1>
    
    <?php if (count($productos_carrito) > 0): ?>
      <div class="cart-grid">
        <div class="cart-items">
          <?php foreach ($productos_carrito as $producto): ?>
            <div class="cart-item">
              <img src="<?= $producto['imagen_thumbnail'] ?>" alt="<?= $producto['nombre'] ?>" class="cart-item-img">
              <div class="cart-item-details">
                <h3 class="cart-item-name"><?= $producto['nombre'] ?></h3>
                <p class="cart-item-price">$<?= number_format($producto['precio'], 2) ?></p>
                <div class="cart-item-actions">
                  <div class="quantity-control">
                    <button class="quantity-btn minus-btn" data-id="<?= $producto['id_parte'] ?>">-</button>
                    <span class="quantity-value" id="cantidad-<?= $producto['id_parte'] ?>"><?= $producto['cantidad'] ?></span>
                    <button class="quantity-btn plus-btn" data-id="<?= $producto['id_parte'] ?>">+</button>
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
        <a href="homePublic.php" class="continue-shopping">
          <i class="fas fa-arrow-left"></i> Continuar comprando
        </a>
      </div>
    <?php endif; ?>
  </main>
</div></div>

  <?php include('footer.php'); ?>
  <?php include('modal_factura_detalle.php'); ?>

  <script>
    document.querySelectorAll('.quantity-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const id_parte = this.dataset.id;
        const cantidadSpan = document.getElementById('cantidad-' + id_parte);
        let cantidad = parseInt(cantidadSpan.textContent);
        const cantidadAnterior = cantidad;

        if (this.classList.contains('minus-btn')) {
          if (cantidad > 0) cantidad--;
        } else if (this.classList.contains('plus-btn')) {
          cantidad++;
        }

        cantidadSpan.textContent = cantidad;

        fetch('../controller_public/agregar_carrito.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `id_parte=${id_parte}&cantidad=${cantidad}`
        })
        .then(res => res.json())
        .then(data => {
          if (!data.ok) {
            cantidadSpan.textContent = cantidadAnterior;
            Swal.fire('Error', data.msg || 'Error al actualizar cantidad', 'error');
          } else {
            location.reload();
          }
        });
      });
    });

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
            fetch('../controller_public/eliminar_carrito.php', {
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

    document.querySelector('.checkout-btn')?.addEventListener('click', function(e) {
      e.preventDefault();

      // Enviar solicitud al backend para registrar el pago
      fetch('../controller_public/registrar_pago.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          id_usuario: <?= json_encode($id_usuario) ?>
        })
      })
      .then(res => res.json())
      .then(data => {
        if (data.ok) {
          Swal.fire({
            title: '¡Pago realizado con éxito!',
            text: 'Gracias por tu compra.',
            icon: 'success',
            confirmButtonText: 'Ver factura'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('modal-factura-detalle').style.display = 'flex';
            }
          });
        } else {
          Swal.fire({
            title: 'Error al procesar el pago',
            text: data.msg || 'Ocurrió un error inesperado.',
            icon: 'error'
          });
        }
      })
      .catch(error => {
        console.error('Error en la solicitud:', error);
        Swal.fire({
          title: 'Error de red',
          text: 'No se pudo completar la transacción.',
          icon: 'error'
        });
      });
    });


  </script>

  
</body>
</html>
