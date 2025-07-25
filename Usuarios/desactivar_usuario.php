<?php
require_once '../clases/conexion.php';

if (!isset($_GET['id'])) {
    echo json_encode(['status' => 'error', 'msg' => 'ID no especificado']);
    exit;
}

$id = intval($_GET['id']);
$db = new mod_db();

$result = $db->updateSeguro("usuarios", ['activo' => 0], ['id_usuario' => $id]);

if ($result) {
    echo json_encode(['status' => 'success', 'msg' => 'Usuario desactivado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Error al desactivar el usuario']);
}
