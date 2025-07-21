<?php
session_start();

require_once(__DIR__ . "/../conexion.php");
require_once(__DIR__ . "/../../comunes/sanitizar.php");
require_once(__DIR__ . "/../Registro/objRegistro.php");
require_once("../logger.php");

$db = new mod_db();
$sanitizador = new SanitizarEntrada($db);

$datosSanitizados = $sanitizador->sanitizarTodo($_POST);
$rol = $sanitizador->getRol();

$errores = $sanitizador->getErrores();

if (!empty($errores)) {
    $_SESSION['registro_errores'] = $errores;
    header("Location: /Rastro-YPan.YSamaniego/registro.php");
    exit;
}

$registro = new RegistroUsuario($db, $rol, $datosSanitizados);

if ($registro->procesarFormulario()) {
    $_SESSION['id_usuario'] = $registro->getDatos()['id_usuario'];
    $_SESSION['correo_usuario'] = $registro->getDatos()['correo'];
    $_SESSION['nombre'] = $registro->getDatos()['usuario'];
    $_SESSION['rol'] = $registro->getDatos()['id_rol'] ?? $rol;

    header("Location: /Rastro-YPan.YSamaniego/login.php");
    exit;
} else {
    $_SESSION['registro_errores'] = $sanitizador->getErrores();
    header("Location: /Rastro-YPan.YSamaniego/registro.php");
    exit;
}
