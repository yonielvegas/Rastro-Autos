<?php
session_start();
header('Content-Type: application/json');
require_once('../comunes/carrito.php');
require_once('../clases/logger.php');

logger::info("Ejecutando registrar_pago.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'msg' => 'Petición inválida']);
    exit;
}

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    echo json_encode(['ok' => false, 'msg' => 'Debes iniciar sesión para pagar']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'] ?? null;

$carrito = new Carrito();
$respuesta = $carrito->pagar($id_usuario);

// Si $respuesta no es un array, devuelve un error genérico
if (!is_array($respuesta)) {
    echo json_encode(['ok' => false, 'msg' => 'Error inesperado al procesar el pago']);
    exit;
}

echo json_encode($respuesta);
exit;
