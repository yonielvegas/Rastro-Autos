<?php
session_start();

// Configuración de rutas base
define('BASE_PATH', realpath(dirname(__FILE__) . '/../..'));
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Rastro-YPan.YSamaniego');

// Incluir archivos necesarios
require_once(BASE_PATH . '/clases/conexion.php');
require_once(BASE_PATH . '/comunes/sanitizar.php');
require_once(BASE_PATH . '/clases/Registro/objRegistro.php');
require_once(BASE_PATH . '/clases/logger.php');
require_once(BASE_PATH . '/comunes/redireccionar.php');

$db = new mod_db();
$sanitizador = new SanitizarEntrada($db);

$datosSanitizados = $sanitizador->sanitizarTodo($_POST);
$rol = $sanitizador->getRol();
$errores = $sanitizador->getErrores();

if (!empty($errores)) {
    $_SESSION['registro_errores'] = $errores;
    header("Location: http://localhost/Rastro-YPan.YSamaniego/registro.php");
    exit;   
}

$registro = new RegistroUsuario($db, $rol, $datosSanitizados);

if ($registro->procesarFormulario()) {
    $_SESSION['id_usuario'] = $registro->getDatos()['id_usuario'];
    $_SESSION['correo_usuario'] = $registro->getDatos()['correo'];
    $_SESSION['nombre'] = $registro->getDatos()['usuario'];
    $_SESSION['rol'] = $registro->getDatos()['id_rol'] ?? $rol;

    header("Location: http://localhost/Rastro-YPan.YSamaniego/login.php");
    exit;
} else {
    $_SESSION['registro_errores'] = $sanitizador->getErrores();
    header("Location: http://localhost/Rastro-YPan.YSamaniego/registro.php");
    exit;
}