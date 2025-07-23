<?php
// Asumimos que $productos_carrito, $total, $impuesto, $total_con_impuesto, $_SESSION['usuario'] ya están definidos.
$fecha_actual = date('Y-m-d H:i');
$nombre_cliente = $_SESSION['usuario'] ?? 'Cliente Desconocido';
$id_cliente = $_SESSION['id_usuario'] ?? 'N/A';
?>

<div id="modal-factura-detalle" class="modal-factura-bg" style="display: none;">
  <div class="modal-factura" style="max-width: 700px;">
    <h2>FACTURA</h2>
    <p><strong>Empresa:</strong> PARTSPRO</p>
    <p><strong>RUC:</strong> 123456789-1-2023 DV56</p>
    <p><strong>Fecha:</strong> <?= $fecha_actual ?></p>
    <p><strong>Cliente:</strong> <?= htmlspecialchars($nombre_cliente) ?> | <strong>ID:</strong> <?= $id_cliente ?></p>

    <table style="width:100%; margin-top: 1rem; border-collapse: collapse; font-size: 0.95rem;">
      <thead>
        <tr style="background-color: #f3f4f6;">
          <th style="padding: 8px; border-bottom: 1px solid #ddd;">Producto</th>
          <th style="padding: 8px; border-bottom: 1px solid #ddd;">Cantidad</th>
          <th style="padding: 8px; border-bottom: 1px solid #ddd;">Precio Unitario</th>
          <th style="padding: 8px; border-bottom: 1px solid #ddd;">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productos_carrito as $producto): ?>
          <tr>
            <td style="padding: 8px;"><?= $producto['nombre'] ?></td>
            <td style="padding: 8px; text-align: center;"><?= $producto['cantidad'] ?></td>
            <td style="padding: 8px; text-align: right;">$<?= number_format($producto['precio'], 2) ?></td>
            <td style="padding: 8px; text-align: right;">$<?= number_format($producto['precio'] * $producto['cantidad'], 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div style="margin-top: 1rem; text-align: right;">
      <p><strong>Subtotal:</strong> $<?= number_format($total, 2) ?></p>
      <p><strong>Impuesto (7%):</strong> $<?= number_format($impuesto, 2) ?></p>
      <p><strong>Total:</strong> $<?= number_format($total_con_impuesto, 2) ?></p>
    </div>

    <div class="modal-footer">
      <button class="btn btn-descargar" id="btn-descargar-factura">Aceptar</button>
    </div>

  </div>
</div>

<style>
  .modal-factura-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .modal-factura {
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
  }

  .cerrar-modal {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    font-size: 24px;
    font-weight: bold;
    color: #888;
    cursor: pointer;
  }

  .modal-factura h2 {
    margin-top: 0;
    font-size: 24px;
    margin-bottom: 1rem;
    text-align: center;
  }

  #contenido-factura {
    font-size: 16px;
    line-height: 1.5;
    color: #333;
    padding: 1rem 0;
  }

  .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
  }

  .btn {
    padding: 0.6rem 1.4rem;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .btn-cerrar {
    background-color: #ccc;
    color: #333;
  }

  .btn-cerrar:hover {
    background-color: #bbb;
  }

  .btn-descargar {
    background-color: #28a745;
    color: white;
  }

  .btn-descargar:hover {
    background-color: #218838;
  }
</style>
<script>
   // Cierra modal y recarga la página al hacer clic en "Aceptar"
  document.getElementById('btn-descargar-factura')?.addEventListener('click', function () {
    // Cierra el modal
    document.getElementById('modal-factura-detalle').style.display = 'none';

    // Refresca la página
    location.reload(); // o también puedes usar: window.location.href = 'carrito.php';
  });
</script>