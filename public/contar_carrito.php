<?php
session_start();
require_once('../clases/conexion.php');

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['total' => 0]);
    exit;
}

$db = new mod_db();
$total = $db->contarProductosCarrito($_SESSION['id_usuario']);

echo json_encode(['total' => intval($total)]);
