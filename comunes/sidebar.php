<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentFile = basename($_SERVER['PHP_SELF']); // ← Esto obtiene el nombre del archivo actual (ej: inventario.php)

// Validación del rol
if (!isset($_SESSION['rol'])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

$rol = $_SESSION['rol'];
if (!in_array($rol, [1, 2])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}
?>


<style>
:root {
  --primary: #4361ee;
  --dark: #212529;
  --sidebar-width: 250px;
  --sidebar-collapsed-width: 80px;
  --header-height: 70px;
}

/* Aumentamos especificidad con el id del contenedor padre */
#app-sidebar-container .sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: var(--sidebar-width);
  background: var(--dark);
  color: white;
  height: 100vh;
  transition: width 0.3s ease;
  z-index: 100;
  overflow: hidden;
  white-space: nowrap;
}

#app-sidebar-container .sidebar.collapsed {
  width: var(--sidebar-collapsed-width);
  overflow: visible;
}

#app-sidebar-container .sidebar.collapsed:hover {
  width: var(--sidebar-width);
  overflow-y: auto;
}

#app-sidebar-container .sidebar-header {
  height: var(--header-height);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  white-space: nowrap;
}

#app-sidebar-container .sidebar-header h3 {
  opacity: 1;
  transition: opacity 0.3s ease, width 0.3s ease;
}

#app-sidebar-container .sidebar.collapsed .sidebar-header h3 {
  opacity: 0;
  width: 0;
  pointer-events: none;
}

#app-sidebar-container .sidebar.collapsed:hover .sidebar-header h3 {
  opacity: 1;
  width: auto;
  pointer-events: auto;
  transition-delay: 0.2s;
}

#app-sidebar-container .toggle-btn {
  background: none;
  border: none;
  color: white;
  font-size: 20px;
  cursor: pointer;
  padding: 5px;
}

#app-sidebar-container .sidebar-menu {
  padding: 20px 0;
}

#app-sidebar-container .menu-item {
  display: flex;
  align-items: center;
  padding: 12px 20px;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: all 0.3s ease;
  white-space: nowrap;
  overflow: hidden;
}

#app-sidebar-container .menu-item:hover,
#app-sidebar-container .menu-item.active {
  background: rgba(255, 255, 255, 0.1);
  color: white;
}

/* Íconos siempre alineados a la izquierda con margen a la derecha */
#app-sidebar-container .menu-item i {
  min-width: 20px;
  font-size: 18px;
  margin-right: 15px;
  transition: margin 0.3s ease;
}

/* Texto oculto al colapsar */
#app-sidebar-container .sidebar.collapsed .menu-item span {
  opacity: 0;
  width: 0;
  pointer-events: none;
  transition: opacity 0.3s ease, width 0.3s ease;
}

/* Mostrar texto al hacer hover sobre sidebar colapsado */
#app-sidebar-container .sidebar.collapsed:hover .menu-item span {
  opacity: 1;
  width: auto;
  pointer-events: auto;
  transition-delay: 0.2s;
}

@media (max-width: 768px) {
  #app-sidebar-container .sidebar {
    width: var(--sidebar-collapsed-width);
    overflow: hidden;
  }
  #app-sidebar-container .sidebar-header h3,
  #app-sidebar-container .menu-item span {
    opacity: 0;
    width: 0;
  }
  #app-sidebar-container .sidebar:hover {
    width: var(--sidebar-width);
    overflow-y: auto;
  }
  #app-sidebar-container .sidebar:hover .sidebar-header h3,
  #app-sidebar-container .sidebar:hover .menu-item span {
    opacity: 1;
    width: auto;
  }
  
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div id="app-sidebar-container">
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h3>Inventario Autos</h3>
      <button class="toggle-btn" id="toggleBtn" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <div class="sidebar-menu">
      <!-- Menú siempre visible para todos -->
      <a href="../home.php" class="menu-item <?php if ($currentFile == 'home.php') echo 'active'; ?>">
        <i class="fas fa-home"></i>
        <span>Inicio</span>
      </a>

      <a href="../inventario/inventario.php" class="menu-item <?php if ($currentFile == 'inventario.php') echo 'active'; ?>">
        <i class="fas fa-boxes"></i>
        <span>Inventario</span>
      </a>

      <!-- Solo para rol 1 (Admin) -->
      <?php if ($rol == 1): ?>
        <a href="../Usuarios/usuario.php" class="menu-item <?php if (in_array($currentFile, ['usuario.php', 'usuario_form.php'])) echo 'active'; ?>">
          <i class="fas fa-user"></i>
          <span>Usuario</span>
        </a>

        <a href="../roles/roles.php" class="menu-item <?php if (in_array($currentFile, ['roles.php', 'roles_form.php'])) echo 'active'; ?>">
          <i class="fas fa-user-tag"></i>
          <span>Roles</span>
        </a>
      <?php endif; ?>

      <!-- Para rol 1 y 2 -->
      <?php if (in_array($rol, [1, 2])): ?>
        <a href="../seccion/seccionMarca.php" class="menu-item <?php if (in_array($currentFile, ['seccionMarca.php', 'seccionEspecifica.php'])) echo 'active'; ?>">
          <i class="fas fa-th-large"></i>
          <span>Secciones</span>
        </a>
      <?php endif; ?>

      <a href="../comunes/logout.php" class="menu-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Cerrar Sesión</span>
      </a>

    </div>
  </div>
</div>

<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('toggleBtn');

  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
    document.body.classList.add('sidebar-collapsed');
  }

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    const isCollapsed = sidebar.classList.contains('collapsed');
    document.body.classList.toggle('sidebar-collapsed', isCollapsed);
    localStorage.setItem('sidebarCollapsed', isCollapsed);
  });
</script>