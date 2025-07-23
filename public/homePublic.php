<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio - Rastro Partes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #2563eb;
      --primary-light: #3b82f6;
      --primary-dark: #1d4ed8;
      --secondary: #10b981;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-700: #374151;
      --white: #ffffff;
      --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
      --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
      --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
      --radius-sm: 0.375rem;
      --radius-md: 0.5rem;
      --radius-lg: 0.75rem;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--gray-100);
      color: var(--gray-700);
      line-height: 1.6;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
    }

    /* Hero Section */
    .hero {
      text-align: center;
      padding: 3rem 0;
      margin-bottom: 2rem;
background: linear-gradient(135deg, #001affff 0%, #5d00a0ff 100%);
      color: var(--white);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto;
      opacity: 0.9;
    }

    /* Section Styling */
    section {
      margin-bottom: 3rem;
      background: var(--white);
      border-radius: var(--radius-lg);
      padding: 2rem;
      box-shadow: var(--shadow-md);
    }

    h2 {
      color: var(--primary);
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
      position: relative;
      padding-bottom: 0.5rem;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--primary);
      border-radius: 2px;
    }

    h3 {
      color: var(--gray-900);
      font-size: 1.4rem;
      margin-bottom: 1rem;
    }

    /* Project Origin */
    .project-origin {
      position: relative;
    }

    .img-container {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      margin: 1.5rem 0;
    }

    .img-container img {
      flex: 1 1 300px;
      max-height: 300px;
      object-fit: cover;
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-sm);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .img-container img:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

/* Team Section */
.team-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* más ancho */
  gap: 2rem;
  margin-top: 1.5rem;
  max-width: 1200px; /* centra el grid */
  margin-left: auto;
  margin-right: auto;
}


    .team-member {
      background: var(--white);
      border-radius: var(--radius-md);
      padding: 1.5rem;
      box-shadow: var(--shadow-sm);
      border-top: 4px solid var(--primary);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-member:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .team-member h4 {
      color: var(--primary);
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .team-member .role {
      color: var(--secondary);
      font-weight: 600;
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }

    /* Features Section */
    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    .feature-card {
      background: var(--white);
      padding: 1.5rem;
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-sm);
      border-left: 4px solid var(--primary);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
    }

    .feature-card h3 {
      color: var(--primary);
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
      
      .hero p {
        font-size: 1rem;
      }
      
      section {
        padding: 1.5rem;
      }
    }

    /* Utility Classes */
    .highlight {
      font-weight: 600;
      color: var(--primary);
    }

    .text-center {
      text-align: center;
    }

    .mb-1 { margin-bottom: 0.5rem; }
    .mb-2 { margin-bottom: 1rem; }
    .mb-3 { margin-bottom: 1.5rem; }
    .mb-4 { margin-bottom: 2rem; }

.catalogo-btn {
  display: inline-block;
  margin-top: 1rem;
  padding: 0.8rem 2rem;
  background-color: var(--white);
  color: var(--primary-dark);
  border: 2px solid var(--white);
  border-radius: var(--radius-md);
  text-decoration: none;
  font-weight: 600;
  font-size: 1rem;
  letter-spacing: 0.5px;
  box-shadow: var(--shadow-md);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.catalogo-btn:hover {
  background-color: var(--gray-100);
  color: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}

.catalogo-btn:active {
  transform: translateY(0);
  box-shadow: var(--shadow-md);
}

/* Versión alternativa con borde azul */
.catalogo-btn.outline {
  background-color: transparent;
  color: var(--white);
  border-color: var(--white);
}

.catalogo-btn.outline:hover {
  background-color: rgba(255, 255, 255, 0.1);
  color: var(--white);
}

  </style>
</head>
<body>

<div class="container">
<section class="hero">
  <h1>Bienvenidos a Rappi-Rastry</h1>
  <p>La plataforma definitiva para la gestión inteligente de repuestos automotrices</p>
  <a href="catalogo.php" class="catalogo-btn">Explorar Catálogo</a>
</section>

  <section>
    <h2>Sobre Rappi-Rastry</h2>
    <p class="mb-3">
      <strong class="highlight">Rappi-Rastry</strong> es una tienda online especializada en repuestos y partes para autos. Ofrecemos una amplia variedad de piezas originales y genéricas para distintas marcas y modelos, brindando a nuestros clientes acceso rápido, seguro y confiable a los componentes que necesitan para mantener sus vehículos en óptimas condiciones.
    </p>
    
    <div class="img-container">
      <img src="../imagenes/vidrios.jpeg" alt="Vidrios automotrices">
      <img src="../imagenes/puertas.jpg" alt="Puertas de vehículos">
    </div>
  </section>

  <section class="project-origin">
    <h2>¿Cómo nació Rappi-Rastry?</h2>
    <div class="mb-3">
      <p>La idea de Rappi-Rastry nació al observar las dificultades de muchas personas para encontrar repuestos específicos sin tener que recorrer múltiples tiendas físicas. Nuestro objetivo fue claro: facilitar la compra de partes automotrices desde la comodidad del hogar.</p>
      
      <p class="mb-2">Desde entonces, nos hemos enfocado en resolver problemas comunes como:</p>
      
      <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
        <li>Demoras en la entrega de piezas</li>
        <li>Falta de disponibilidad de marcas confiables</li>
        <li>Precios poco competitivos</li>
        <li>Dificultad para encontrar repuestos específicos por modelo</li>
      </ul>
      
      <p>Rappi-Rastry fue creado para eliminar estas barreras y ofrecer una experiencia de compra moderna, eficiente y segura. Nuestro compromiso es conectar a nuestros clientes con los mejores repuestos, sin complicaciones.</p>
    </div>
  </section>

  <section>
    <h2>Nuestro Equipo</h2>
    <h3>Quienes hacen posible Rappi-Rastry</h3>
    
    <div class="team-grid">
      <div class="team-member">
        <h4>Yini Pan</h4>
        <p class="role">Líder de Diseño y Experiencia de Usuario</p>
        <p>Encargada de que la tienda sea visualmente atractiva y fácil de navegar para nuestros clientes.</p>
      </div>
      
      <div class="team-member">
        <h4>Yoel Samaniego</h4>
        <p class="role">Desarrollador Backend & Seguridad</p>
        <p>Responsable del sistema de pedidos, pagos en línea y protección de datos del cliente.</p>
      </div>
      
      <div class="team-member">
        <h4>Eric Ruiz</h4>
        <p class="role">Especialista en Catálogo de Productos</p>
        <p>Administra el inventario en línea y asegura que cada pieza tenga la información y fotos correctas.</p>
      </div>
      
      <div class="team-member">
        <h4>Gabriel González</h4>
        <p class="role">Logística & Atención al Cliente</p>
        <p>Encargado de las entregas rápidas y la resolución efectiva de dudas o problemas postventa.</p>
      </div>
    </div>
  </section>

  <section>
    <h2>¿Qué ofrecemos?</h2>
    <p class="mb-3">En Rappi-Rastry ponemos a tu alcance productos y servicios que hacen la diferencia:</p>
    
    <div class="features">
      <div class="feature-card">
        <h3>Amplio Catálogo</h3>
        <p>Piezas para múltiples marcas y modelos, incluyendo carrocería, vidrios, puertas, luces, y más.</p>
      </div>
      
      <div class="feature-card">
        <h3>Filtros de Búsqueda Inteligente</h3>
        <p>Encuentra exactamente lo que buscas por tipo, marca, modelo, año o categoría.</p>
      </div>
      
      <div class="feature-card">
        <h3>Compra Segura</h3>
        <p>Procesos de pago protegidos y múltiples métodos de envío confiables en todo el país.</p>
      </div>
      
      <div class="feature-card">
        <h3>Soporte Personalizado</h3>
        <p>Asistencia en línea para resolver tus dudas y ayudarte a elegir la pieza adecuada.</p>
      </div>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
