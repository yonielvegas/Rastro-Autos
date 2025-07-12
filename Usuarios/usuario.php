<?php
include 'modal_usuario.php';

// Ejemplo de usuarios — en la práctica los obtienes de base de datos
$usuarios = [
  ['id'=>1,'nombre'=>'Juan Pérez','email'=>'juan@example.com','rol'=>1,'activo'=>1],
  ['id'=>2,'nombre'=>'María García','email'=>'maria@example.com','rol'=>2,'activo'=>0],
];

function nombreRol($rol) {
  return $rol == 1 ? 'Administrador' : 'Usuario';
}

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
              <th>Email</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= nombreRol($usuario['rol']) ?></td>
                <td><?= badgeEstado($usuario['activo']) ?></td>
                <td>
                  <div class="action-buttons">
                    <a href="#" class="btn btn-sm btn-edit" onclick='abrirModalUsuario(<?= json_encode($usuario) ?>); return false;'>Editar</a>
                    <?php if ($usuario['activo'] == 1): ?>
                      <a href="desactivar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-deactivate">Desactivar</a>
                    <?php else: ?>
                      <a href="activar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-activate">Activar</a>
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
  //Manejar el responsive del sidebar NO TOCARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
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
