<?php
session_start();
require_once '../clases/conexion.php'; 
$db = new mod_db();

// --- RECUPERAR Y LIMPIAR VARIABLES DE SESIÓN DE FORMA SEGURA ---
$errores = $_SESSION['errores_usuario'] ?? [];
$abrir_modal = $_SESSION['abrir_modal'] ?? false;
$form_data = $_SESSION['form_data'] ?? [];
$es_edicion = $_SESSION['es_edicion'] ?? false;
$mensaje_exito = $_SESSION['mensaje_exito'] ?? null;
$fue_redireccion_por_error = $_SESSION['redireccion_por_error'] ?? false;


// >>>>>> LÓGICA DE LIMPIEZA CRÍTICA <<<<<<
unset($_SESSION['errores_usuario']);
unset($_SESSION['abrir_modal']);
unset($_SESSION['form_data']);
unset($_SESSION['es_edicion']);
unset($_SESSION['redireccion_por_error']);
unset($_SESSION['mensaje_exito']);

// Traer usuarios desde la tabla real de la base de datos
$usuarios = $db->select(
    "usuarios",
    "id_usuario AS id, CONCAT(nombre, ' ', apellido) AS nombre, usuario, telefono, correo AS email, id_rol AS rol, activo",
    ""
);

// Función para mostrar el nombre del rol (ej: 1=Administrador, 2=Usuario)
function nombreRol($rol) {
    return $rol == 1 ? 'Administrador' : 'Usuario';
}

// Función para mostrar el estado con un 'badge' visual
function badgeEstado($activo) {
    return $activo == 1
        ? '<span class="badge badge-success">Activo</span>'
        : '<span class="badge badge-danger">Inactivo</span>';
}
?>

<?php include 'modal_usuario.php'; // Incluye el HTML del modal, que está en la misma carpeta 'Usuarios' ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloLista.css" /> <title>Usuarios - Sistema de Inventario</title>
</head>
<body>

<?php include '../comunes/sidebar.php'; ?> <div class="main-content" id="mainContent">
  <div class="container">
    <div class="header">
      <h2>Gestión de Usuarios</h2>
      <a href="#" class="btn btn-primary" onclick="abrirModalUsuario(); return false;">
        <i class="fas fa-plus"></i> Nuevo Usuario
      </a>
    </div>

    <?php if ($mensaje_exito): ?>
      <div id="mensajeExito" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
        <?= htmlspecialchars($mensaje_exito) ?>
      </div>
    <?php endif; ?>

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
  // Script que se ejecuta una vez que el DOM está completamente cargado
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalUserForm');

    // --- Lógica para abrir el modal automáticamente si hay errores de una redirección ---
    <?php if ($fue_redireccion_por_error && !empty($errores)): ?>
      // Llama a abrirModalUsuario con los datos del formulario que causó el error.
      // Estos datos ya contienen los errores y el modal se mostrará precargado.
      abrirModalUsuario(<?= json_encode($form_data) ?>);
    <?php endif; ?>

    // --- Lógica para cerrar el modal si hubo un registro/actualización exitoso ---
    <?php if ($mensaje_exito && !$fue_redireccion_por_error): ?>
      if (modal && modal.style.display === 'block') { // Solo si ya está visible
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar el scroll del body
      }
    <?php endif; ?>

    //Manejar el responsive del sidebar (mantener como está)
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', function () {
      sidebar.classList.toggle('collapsed');

      const mainContent = document.getElementById('mainContent');
      if (mainContent) {
        mainContent.classList.toggle('expanded');
      }
    });
    const mensaje = document.getElementById('mensajeExito');
    if (mensaje) {
      setTimeout(() => {
        mensaje.style.display = 'none';
      }, 3000); // 5000 milisegundos = 5 segundos
    }
  });
</script>
</body>
</html>