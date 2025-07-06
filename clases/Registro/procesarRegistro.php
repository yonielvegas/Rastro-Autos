<?php
session_start();
require_once("conexion.php");
require_once("comunes/sanitizar.php");
require_once("objRegistro.php");

$db = new mod_db();
$sanitizador = new SanitizarEntrada($db);

$datosSanitizados = $sanitizador->sanitizarTodo($_POST);

$errores = $sanitizador->getErrores();

if (!empty($errores)) {
    $_SESSION['registro_errores'] = $errores;
    header("Location: ../registro.php");
    exit;
}

$registro = new RegistroUsuario($db, $datosSanitizados);
if ($registro->procesarFormulario()) {
    $_SESSION['usuario_id'] = $registro->getDatos()['id'];
    $_SESSION['correo_usuario'] = $registro->getDatos()['correo'];
    $_SESSION['nombre'] = $registro->getDatos()['usuario'];
    Logger::debug($_SESSION['nombre']);
    header("Location: ../login.php");
    exit;
} else {
    $_SESSION['registro_errores'] = $sanitizador->getErrores();
    header("Location: ../registro.php");
    exit;
}
