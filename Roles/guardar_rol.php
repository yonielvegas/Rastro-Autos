<?php
require_once '../clases/conexion.php';
$db = new mod_db();

$usuarioNombre = $_POST['usuario'] ?? '';
$rolNombre = $_POST['rol'] ?? '';
$permisos = $_POST['permisos'] ?? []; // array de permisos

// Validar que usuario y rol no estén vacíos
if (!$usuarioNombre || !$rolNombre) {
    die('Usuario y rol son requeridos');
}

// Buscar id_usuario
$sqlUsuario = "SELECT id_usuario FROM usuarios WHERE CONCAT(nombre, ' ', apellido) = ?";
$stmt = $db->getConexion()->prepare($sqlUsuario);
$stmt->execute([$usuarioNombre]);
$idUsuario = $stmt->fetchColumn();

if (!$idUsuario) {
    die('Usuario no encontrado');
}

// Buscar id_rol
$sqlRol = "SELECT id_rol FROM roles WHERE nombre_rol = ?";
$stmt = $db->getConexion()->prepare($sqlRol);
$stmt->execute([$rolNombre]);
$idRol = $stmt->fetchColumn();

if (!$idRol) {
    die('Rol no encontrado');
}

// 1. Actualizar rol del usuario
$sqlDeleteRol = "DELETE FROM usuarios_roles WHERE id_usuario = ?";
$stmt = $db->getConexion()->prepare($sqlDeleteRol);
$stmt->execute([$idUsuario]);

$sqlInsertRol = "INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (?, ?)";
$stmt = $db->getConexion()->prepare($sqlInsertRol);
$stmt->execute([$idUsuario, $idRol]);

// 2. Actualizar permisos personalizados del usuario

// Validación de permisos obligatorios
if (in_array('escritura', $permisos) || in_array('generar_reporte', $permisos)) {
    if (!in_array('lectura', $permisos)) {
        $permisos[] = 'lectura';
    }
}

// Eliminar permisos antiguos del usuario
$sqlDeletePermisos = "DELETE FROM permisos_usuarios WHERE id_usuario = ?";
$stmt = $db->getConexion()->prepare($sqlDeletePermisos);
$stmt->execute([$idUsuario]);

// Insertar nuevos permisos
$sqlInsertPermiso = "INSERT INTO permisos_usuarios (id_usuario, id_permiso) VALUES (?, ?)";
$stmtPermiso = $db->getConexion()->prepare($sqlInsertPermiso);

foreach ($permisos as $permisoNombre) {
    $sqlPermiso = "SELECT id_permiso FROM permisos WHERE nombre_permiso = ?";
    $stmt = $db->getConexion()->prepare($sqlPermiso);
    $stmt->execute([$permisoNombre]);
    $idPermiso = $stmt->fetchColumn();
    if ($idPermiso) {
        $stmtPermiso->execute([$idUsuario, $idPermiso]);
    }
}

// Mostrar mensaje con SweetAlert2
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Configuración Guardada</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
  Swal.fire({
    icon: 'success',
    title: '¡Éxito!',
    text: 'Configuración guardada correctamente.',
    confirmButtonText: 'Aceptar'
  }).then(() => {
    // Opcional: redirigir a la página de asignar roles, cambia la ruta según tu proyecto
    window.location.href = 'roles.php';
  });
</script>
</body>
</html>
