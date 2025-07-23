<?php
session_start();
require_once('../clases/conexion.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    $id_parte = intval($_POST['id_parte'] ?? 0);

    if (!$id_usuario || !$id_parte) {
        echo json_encode(['ok' => false, 'msg' => 'Datos inválidos']);
        exit;
    }

    logger::info(" ANtes de llamar el metrodo Eliminando producto con ID $id_parte del carrito del usuario $id_usuario");

    $db = new mod_db();
    $res = $db->eliminarProductoCarrito($id_usuario, $id_parte);

    if ($res) {
        echo json_encode(['ok' => true]);
    } else {
        echo json_encode(['ok' => false, 'msg' => 'No se pudo eliminar el producto']);
    }
    exit;
}
echo json_encode(['ok' => false, 'msg' => 'Petición inválida']);
exit;