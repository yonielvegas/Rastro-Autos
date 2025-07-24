<?php

require_once '../clases/logger.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
logger::info("Contenido de la sesión EN USUARIO:\n" . print_r($_SESSION, true));

if (!isset($_SESSION['rol'])) {
    header("Location: ../Inventario/inventario.php"); //Cambiar Pagina
    exit();
}

include 'modal_usuario.php';
include '../comunes/navbar.php';
require_once '../clases/conexion.php';

$db = new mod_db();
$usuarios = $db->query("
  SELECT u.*, r.nombre_rol
  FROM usuarios u
  LEFT JOIN usuarios_roles ur ON u.id_usuario = ur.id_usuario
  LEFT JOIN roles r ON ur.id_rol = r.id_rol
  WHERE r.id_rol IN (1, 2)
");


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
  <style>
    .search-bar {
      align-items: left;
      width: 250px; 
    }

    .search-bar input {
      width: 100%; 
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      display: block;
    }

  </style>
</head>
<body>

<?php include '../comunes/sidebar.php'; ?>

<div class="main-content" id="mainContent" style="padding-top: 70px;">
  <div class="container">
<div class="header">
  <h2>Gestión de Usuarios</h2>

  <!-- Barra de búsqueda -->
  <div class="search-bar">
    <input type="text" id="busqueda" placeholder="Buscar usuario...">
  </div>

  <a href="#" class="btn btn-primary" onclick="abrirModalUsuario(); return false;">
    <i class="fas fa-plus"></i> Nuevo Usuario
  </a>
</div>
    <div class="card">
      <div class="table-responsive">
        <table id="tablaUsuarios">
          <thead>
            <tr>              
              <th>Rol</th>
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
                <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
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
                      <a href="#" class="btn btn-sm btn-deactivate btn-toggle" data-id="<?= $usuario['id_usuario'] ?>" data-action="desactivar">Desactivar</a>
                    <?php else: ?>
                      <a href="#" class="btn btn-sm btn-activate btn-toggle" data-id="<?= $usuario['id_usuario'] ?>" data-action="activar">Activar</a>
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
  // Búsqueda en tabla por nombre, apellido, correo, usuario, etc.
  document.getElementById('busqueda').addEventListener('input', function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaUsuarios tbody tr');

    filas.forEach(fila => {
      const texto = fila.textContent.toLowerCase();
      fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
  });

  document.querySelectorAll('.btn-toggle').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.dataset.id;
      const accion = this.dataset.action;

      fetch(`${accion}_usuario.php?id=${id}`, {
        method: 'GET',
      })
      .then(response => response.text())
      .then(data => {
        console.log("Respuesta del servidor:", data);
        // Opcional: puedes actualizar la fila, recargar la tabla o solo el estado
        location.reload(); // O mejora reemplazando solo la fila con JS
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  });
</script>
</body>
</html>
