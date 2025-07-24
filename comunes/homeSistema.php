<?php
  include 'navbar.php';
  include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            
        }
        
        .main-content .dashboard {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .main-content .module {
            position: relative;
            height: 280px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .main-content .module:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        
        .module-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .module:hover .module-img {
            transform: scale(1.05);
        }
        
        .main-content .module-title {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            font-size: 28px;
            font-weight: 800;
            text-align: left;
            padding: 10px 20px;
            margin: 0;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-left: 8px solid #1405e3ff;
        }
        
        .module-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.58) 0%, rgba(0, 7, 207, 0.45) 100%);
        }
        
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .module {
                height: 220px;
                  display: block;
                    position: relative;
                    text-decoration: none;
                    color: inherit;
            }
            
            .module-title {
                font-size: 22px;
                padding: 8px 15px;
            }
        }

        .main-content {
        margin-left: var(--sidebar-width);
        transition: margin-left 0.3s ease;
        padding: 20px;
        }

        .sidebar.collapsed + .main-content,
        body.sidebar-collapsed .main-content {
        margin-left: var(--sidebar-collapsed-width);
        }

    </style>
</head>
<body>
<div class="main-content" id="mainContent" style="padding-top: 200px;">
    <div class="dashboard">
        <?php if ($rol == 1): ?>
        <!-- Módulo 1 -->
        <a href="../Usuarios/usuario.php" class="module">
            <img src="../imagenes/usuarios.jpg" alt="Usuarios" class="module-img">
            <div class="module-overlay"></div>
            <h2 class="module-title">Usuarios</h2>
        </a>

        <!-- Módulo 2 -->
        <a href="../Roles/roles.php" class="module">
            <img src="../imagenes/roles.jpeg" alt="Roles y Permisos" class="module-img">
            <div class="module-overlay"></div>
            <h2 class="module-title">Roles y Permisos</h2>
        </a>
        <?php endif; ?>

        <?php if (in_array($rol, [1, 2])): ?>
        <!-- Módulo 3 -->
        <a href="../Inventario/inventario.php" class="module">
            <img src="../imagenes/inventario.jpg" alt="Inventario" class="module-img">
            <div class="module-overlay"></div>
            <h2 class="module-title">Inventario</h2>
        </a>

        <!-- Módulo 4 -->
        <a href="../Seccion/seccionMarca.php" class="module">
            <img src="../imagenes/seccion.jpeg" alt="Secciones" class="module-img">
            <div class="module-overlay"></div>
            <h2 class="module-title">Secciones</h2>
        </a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>