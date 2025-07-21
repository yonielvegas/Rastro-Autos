<?php
  $currentFile = basename($_SERVER['PHP_SELF']); // Nombre del archivo actual
?>
<style>
:root {
  --primary: #4361ee;
  --dark: #212529;
  --sidebar-width: 250px;
  --sidebar-collapsed-width: 80px;
  --header-height: 70px;
}

.sidebar {
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

.sidebar.collapsed {
  width: var(--sidebar-collapsed-width);
  overflow: visible;
}

.sidebar.collapsed:hover {
  width: var(--sidebar-width);
  overflow-y: auto;
}

.sidebar-header {
  height: var(--header-height);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  white-space: nowrap;
}

.sidebar-header h3 {
  opacity: 1;
  transition: opacity 0.3s ease, width 0.3s ease;
}

.sidebar.collapsed .sidebar-header h3 {
  opacity: 0;
  width: 0;
  pointer-events: none;
}

.sidebar.collapsed:hover .sidebar-header h3 {
  opacity: 1;
  width: auto;
  pointer-events: auto;
  transition-delay: 0.2s;
}

.toggle-btn {
  background: none;
  border: none;
  color: white;
  font-size: 20px;
  cursor: pointer;
  padding: 5px;
}

.sidebar-menu {
  padding: 20px 0;
}

.menu-item {
  display: flex;
  align-items: center;
  padding: 12px 20px;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: all 0.3s ease;
  white-space: nowrap;
  overflow: hidden;
}

.menu-item:hover,
.menu-item.active {
  background: rgba(255, 255, 255, 0.1);
  color: white;
}

/* Íconos siempre alineados a la izquierda con margen a la derecha */
.menu-item i {
  min-width: 20px;
  font-size: 18px;
  margin-right: 15px;
  transition: margin 0.3s ease;
}

/* Texto oculto al colapsar */
.sidebar.collapsed .menu-item span {
  opacity: 0;
  width: 0;
  pointer-events: none;
  transition: opacity 0.3s ease, width 0.3s ease;
}

/* Mostrar texto al hacer hover sobre sidebar colapsado */
.sidebar.collapsed:hover .menu-item span {
  opacity: 1;
  width: auto;
  pointer-events: auto;
  transition-delay: 0.2s;
}

@media (max-width: 768px) {
  .sidebar {
    width: var(--sidebar-collapsed-width);
    overflow: hidden;
  }
  .sidebar-header h3,
  .menu-item span {
    opacity: 0;
    width: 0;
  }
  .sidebar:hover {
    width: var(--sidebar-width);
    overflow-y: auto;
  }
  .sidebar:hover .sidebar-header h3,
  .sidebar:hover .menu-item span {
    opacity: 1;
    width: auto;
  }
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h3>Inventario Autos</h3>
    <button class="toggle-btn" id="toggleBtn" aria-label="Toggle sidebar">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <div class="sidebar-menu">
    <a href="../home.php" class="menu-item <?php if (in_array($currentFile, ['home.php'])) echo 'active'; ?>">
      <i class="fas fa-home"></i>
      <span>Inicio</span>
    </a>
    <a href="../inventario/inventario.php" class="menu-item <?php if (in_array($currentFile, ['inventario.php'])) echo 'active'; ?>">
      <i class="fas fa-boxes"></i>
      <span>Inventario</span>
    </a>
    <a href="../usuarios/usuario.php" class="menu-item <?php if (in_array($currentFile, ['usuario.php', 'usuario_form.php'])) echo 'active'; ?>">
      <i class="fas fa-user"></i>
      <span>Usuario</span>
    </a>
    <a href="../roles/roles.php" class="menu-item <?php if (in_array($currentFile, ['roles.php', 'roles_form.php'])) echo 'active'; ?>">
      <i class="fas fa-user-tag"></i>
      <span>Roles</span>
    </a>
    <a href="../secciones/secciones.php" class="menu-item <?php if (in_array($currentFile, ['secciones.php', 'secciones_form.php'])) echo 'active'; ?>">
      <i class="fas fa-th-large"></i>
      <span>Secciones</span>
    </a>
    <a href="../comunes/logout.php" class="menu-item">
      <i class="fas fa-sign-out-alt"></i>
      <span>Cerrar Sesión</span>
    </a>
  </div>

</div>
