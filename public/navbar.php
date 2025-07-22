<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PARTSPRO</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --primary-color: #2563eb;
      --primary-hover: #1d4ed8;
      --text-color: #334155;
      --text-light: #64748b;
      --bg-color: #ffffff;
      --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
      --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      --border-radius: 8px;
    }

    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body, html {
      font-family: 'Inter', sans-serif;
      line-height: 1.5;
      color: var(--text-color);
      background-color: #f8fafc;
    }

    .main-header {
      width: 100%;
      padding: 0 2rem;
      background-color: var(--bg-color);
      box-shadow: var(--shadow-md);
      position: sticky;
      top: 0;
      z-index: 50;
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .header-container {
      max-width: 1440px;
      margin: 0 auto;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .logo {
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--primary-color);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: var(--transition);
    }

    .logo:hover {
      color: var(--primary-hover);
      transform: translateY(-1px);
    }

    .logo-icon {
      font-size: 1.5em;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    .nav-link {
      color: var(--text-light);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
      position: relative;
      padding: 0.5rem 0;
    }

    .nav-link:hover {
      color: var(--primary-color);
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background-color: var(--primary-color);
      transition: var(--transition);
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .user-actions {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 1rem;
      border-radius: var(--border-radius);
      transition: var(--transition);
      cursor: pointer;
    }

    .user-info:hover {
      background-color: rgba(37, 99, 235, 0.1);
    }

    .user-photo {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(37, 99, 235, 0.2);
      transition: var(--transition);
    }

    .user-info:hover .user-photo {
      border-color: var(--primary-color);
      transform: scale(1.05);
    }

    .user-name {
      font-weight: 500;
      color: var(--text-color);
    }

    .icon-link {
      color: var(--text-light);
      text-decoration: none;
      font-size: 1.25rem;
      transition: var(--transition);
      position: relative;
      padding: 0.5rem;
    }

    .icon-link:hover {
      color: var(--primary-color);
      transform: translateY(-2px);
    }

    .cart-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--primary-color);
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .btn {
      padding: 0.5rem 1.25rem;
      border-radius: var(--border-radius);
      font-weight: 500;
      transition: var(--transition);
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary {
      background-color: var(--primary-color);
      color: white;
      border: 2px solid var(--primary-color);
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: var(--shadow-sm);
    }

    .btn-outline {
      background-color: transparent;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
    }

    .btn-outline:hover {
      background-color: rgba(37, 99, 235, 0.1);
      transform: translateY(-2px);
      box-shadow: var(--shadow-sm);
    }

    @media (max-width: 768px) {
      .main-header {
        padding: 0 1rem;
      }

      .header-content {
        flex-direction: column;
        align-items: stretch;
        gap: 1.5rem;
        padding: 1rem 0;
      }

      .nav-links {
        gap: 1rem;
        justify-content: center;
        border-top: 1px solid rgba(0,0,0,0.05);
        padding-top: 1rem;
      }

      .user-actions {
        justify-content: center;
        border-top: 1px solid rgba(0,0,0,0.05);
        padding-top: 1rem;
        gap: 1rem;
      }
    }

    @media (max-width: 480px) {
      .logo {
        font-size: 1.5rem;
      }

      .user-info {
        padding: 0.5rem;
      }

      .user-name {
        display: none;
      }
    }
  </style>
</head>
<body>
  <header class="main-header">
    <div class="header-container">
      <div class="header-content">
        <div class="left-section" style="display: flex; align-items: center; gap: 2rem;">
          <a href="index.html" class="logo">
            <i class="fas fa-cogs logo-icon"></i>
            <span>PARTSPRO</span>
          </a>

          <nav class="nav-links">
            <a href="home.php" class="nav-link">Inicio</a>
            <a href="catalogo.php" class="nav-link">Catálogo</a>
          </nav>
        </div>

        <div class="user-actions">
          <?php if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == "SI"): ?>
            <div class="user-info">
              <img src="<?= $_SESSION['foto'] ?? 'default-user.jpg' ?>" alt="Foto de usuario" class="user-photo">
              <span class="user-name"><?= htmlspecialchars($_SESSION['usuario']) ?></span>
            </div>
            <a href="carrito.php" class="icon-link" title="Carrito">
              <i class="fas fa-shopping-cart"></i>
              <span class="cart-count">3</span>
            </a>
            <a href="../comunes/logout.php" class="nav-link">Cerrar sesión</a>
          <?php else: ?>
            <a href="../login.php" class="btn btn-outline">Iniciar sesión</a>
            <a href="../registro.php" class="btn btn-primary">Registrarse</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
</body>
</html>
