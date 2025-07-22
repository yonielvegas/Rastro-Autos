<?php
session_start();  
include("clases/conexion.php");	
include("comunes/sanitizar.php");
include("comunes/redireccionar.php");
include("clases/Login/procesarFormulario.php");
require_once ("clases/logger.php");

$db = new mod_db();

$tolog = false;

if (isset($_POST["tolog"])) {
    $tolog = $_POST["tolog"];
    $usuario = $_POST["usuario"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';
    $ipRemoto = $_SERVER['REMOTE_ADDR'];
    $Logearme = new ValidacionLogin($usuario, $contrasena, $ipRemoto, $db);
}

if ($Logearme->logger()) {
    // Verifica si el usuario está bloqueado antes de autenticar
    $errores = $Logearme->getErrores();
    if (!empty($errores) && in_array("Este Usuario Está Bloqueado", $errores)) {
        $_SESSION['errores_login'] = $errores;
        redireccionar("login.php");
    }

    $Logearme->autenticar();
    $rol = $Logearme->getRol();

    if ($Logearme->getIntentoLogin()) {
        $_SESSION['autenticado'] = "SI";
        $_SESSION['usuario'] = $Logearme->getUsuario();
        $_SESSION['foto'] = "https://via.placeholder.com/32";
        $Logearme->registrarIntentos(1);
        $tolog = false;

        $errores = $Logearme->getErrores();
        Logger::info("ERRORES DE BLOQUEO: " . json_encode($errores));
        if (!empty($errores)) {
            $_SESSION['errores_login'] = $errores;
            redireccionar("login.php");
        }

        if ($rol == 1 || $rol == 2) {
            $_SESSION['rol'] = $rol;
            redireccionar("Usuarios/usuario.php");
        } elseif ($rol == 3){
            $_SESSION['rol'] =$rol;
            redireccionar("public/catalogo.php");
        } else {
            redireccionar("login.php");
        }
    } else {
        // Manejo de errores de login fallido
        $errores = $Logearme->getErrores();
        if (!empty($errores)) {
            $_SESSION['errores_login'] = $errores;
        } else {
            $_SESSION['errores_login'] = ["Usuario o Contraseña Incorrectos"];
        }
        $Logearme->registrarIntentos(0);
        redireccionar("login.php");
    }
} else {
    // Usuario no encontrado o bloqueado
    $errores = $Logearme->getErrores();
    if (!empty($errores)) {
        $_SESSION['errores_login'] = $errores;
    } else {
        $_SESSION['errores_login'] = ["Usuario o Contraseña Incorrectos"];
    }
    redireccionar("login.php");
}
?>
