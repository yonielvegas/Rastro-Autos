<?php
require_once '../clases/conexion.php';
$db = new mod_db();
session_start();

$id_usuario = $_GET['id'] ?? '';

if (empty($id_usuario)) {
    $_SESSION['mensaje_error'] = "ID de usuario inválido.";
    header("Location: usuario.php");
    exit;
}

// Sanitizar si quieres
$id_usuario = intval($id_usuario);

// Actualizar activo a 0 (inactivo)
$resultado = $db->updateSeguro("usuarios", ['activo' => 0], ['id_usuario' => $id_usuario]);

if ($resultado) {
    $_SESSION['mensaje_exito'] = "Usuario desactivado correctamente.";
} else {
    $_SESSION['mensaje_error'] = "Error al desactivar usuario.";
}

header("Location: usuario.php");
exit;
