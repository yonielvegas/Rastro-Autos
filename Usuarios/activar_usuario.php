<?php
require_once '../clases/conexion.php';

if (!isset($_GET['id'])) {
    echo json_encode(['status' => 'error', 'msg' => 'ID no especificado']);
    exit;
}

$id = intval($_GET['id']);
$db = new mod_db();

$result = $db->updateSeguro("usuarios", ['activo' => 1], ['id_usuario' => $id]);

if ($result) {
    echo json_encode(['status' => 'success', 'msg' => 'Usuario activado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Error al activar el usuario']);
}
