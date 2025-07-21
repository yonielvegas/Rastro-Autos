<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalles de Parte | Rastro de Partes de Autos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estiloDetalles.css">
    <style>
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body>
  <?php include('navbar.php'); ?>
  
  <main class="container">
    <section class="detail-hero">
      <div class="detail-hero-content">
        <a href="listado_partes.php" class="back-button">
          <i class="fas fa-arrow-left"></i> Volver al catálogo
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
          <span class="stock-badge">En stock (5 unidades)</span>
        </div>
        
        <p class="detail-description">
          Alternador original de alta calidad para Toyota Corolla, compatible con modelos 2014-2018 equipados con motor 1.8L. Esta pieza OEM garantiza un rendimiento óptimo y una larga vida útil. Fabricado con materiales resistentes y tecnología avanzada para asegurar una carga eficiente del sistema eléctrico de tu vehículo.
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
        </div>
        <div class="action-buttons">
          <?php if (isset($_SESSION['usuario'])): ?>
            <button class="btn btn-primary">
              <i class="fas fa-shopping-cart"></i> Añadir al carrito
            </button>
          <?php endif; ?>
        </div>
        </div>
      </div>
    </div>

    <!-- Tabs Section -->
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
    // Sistema de tabs
    function openTab(evt, tabName) {
      const tabContents = document.querySelectorAll('.tab-content');
      const tabButtons = document.querySelectorAll('.tab-btn');
      
      // Ocultar todos los contenidos de tabs
      tabContents.forEach(content => {
        content.classList.remove('active');
      });
      
      // Desactivar todos los botones de tabs
      tabButtons.forEach(button => {
        button.classList.remove('active');
      });
      
      // Mostrar el tab actual y activar el botón
      document.getElementById(tabName).classList.add('active');
      evt.currentTarget.classList.add('active');
    }

    // Activar el primer tab por defecto
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('.tab-btn').click();
    });
  </script>
  
  <?php include('footer.php'); ?>
</body>
</html>