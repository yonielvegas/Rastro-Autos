<?php
session_start();

// Verifica que sea admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../Inventario/inventario.php"); //Cambiar Pagina
    exit();
}

include 'modal_usuario.php';
include '../comunes/navbar.php';
include '../clases/conexion.php';

// Ejemplo de usuarios — en la práctica los obtienes de base de datos
$db = new mod_db();
$usuarios = $db->select("usuarios", "*", "");

function badgeEstado($activo) {
  return $activo == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloLista.css" />
  <title>Usuarios - Sistema de Inventario</title>
</head>
<body>

<?php include '../comunes/sidebar.php'; ?>

<div class="main-content" id="mainContent">
  <div class="container">
    <div class="header">
      <h2>Gestión de Usuarios</h2>
      <a href="#" class="btn btn-primary" onclick="abrirModalUsuario(); return false;">
        <i class="fas fa-plus"></i> Nuevo Usuario
      </a>
    </div>

    <div class="card">
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Usuario</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['apellido']) ?></td>
                <td><?= htmlspecialchars($usuario['correo']) ?></td>
                <td><?= htmlspecialchars($usuario['telefono']) ?></td>
                <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                <td><?= badgeEstado($usuario['activo']) ?></td>
                <td>
                  <div class="action-buttons">
                    <a href="#" class="btn btn-sm btn-edit"
                       onclick='abrirModalUsuario(<?= json_encode($usuario, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>); return false;'>
                       Editar
                    </a>
                    <?php if ($usuario['activo'] == 1): ?>
                      <a href="desactivar_usuario.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-sm btn-deactivate">Desactivar</a>
                    <?php else: ?>
                      <a href="activar_usuario.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-sm btn-activate">Activar</a>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  // Manejar el responsive del sidebar NO TOCAR
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', function () {
      sidebar.classList.toggle('collapsed');

      const mainContent = document.getElementById('mainContent');
      if (mainContent) {
        mainContent.classList.toggle('expanded');
      }
    });
  });
</script>
</body>
</html>
