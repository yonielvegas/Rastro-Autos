<?php
session_start();
header('Content-Type: application/json');
require_once('../comunes/carrito.php');
require_once('../clases/logger.php');

logger::info("Ejecutando agregar_carrito.php");
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'msg' => 'Petición inválida']);
    exit;
}

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    echo json_encode(['ok' => false, 'msg' => 'Debes iniciar sesión para agregar al carrito']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'] ?? null;
$id_parte = intval($_POST['id_parte'] ?? 0);
$cantidad = intval($_POST['cantidad']);

logger::info("Intento de agregar al carrito: Usuario ID $id_usuario, Parte ID $id_parte, Cantidad $cantidad");

$carrito = new Carrito();
$respuesta = $carrito->agregar($id_usuario, $id_parte, $cantidad);

echo json_encode($respuesta);
exit;
