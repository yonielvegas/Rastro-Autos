<?php
require_once '../clases/conexion.php';
$db = new mod_db();
session_start();

$id_usuario = $_GET['id'] ?? '';
if (empty($id_usuario)) {
    echo "ID inválido";
    exit;
}

$id_usuario = intval($id_usuario);
$resultado = $db->updateSeguro("usuarios", ['activo' => 1], ['id_usuario' => $id_usuario]);

echo $resultado ? "OK" : "ERROR";
exit;
