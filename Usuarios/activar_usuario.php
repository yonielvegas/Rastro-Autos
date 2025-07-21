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

$id_usuario = intval($id_usuario);

$resultado = $db->updateSeguro("usuarios", ['activo' => 1], ['id_usuario' => $id_usuario]);

if ($resultado) {
    $_SESSION['mensaje_exito'] = "Usuario activado correctamente.";
} else {
    $_SESSION['mensaje_error'] = "Error al activar usuario.";
}

header("Location: usuario.php");
exit;
