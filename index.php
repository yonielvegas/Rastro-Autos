<?php
session_start();  
include("clases/conexion.php");	
include("comunes/sanitizar.php");
include("comunes/redireccionar.php");
include("clases/Login/procesarFormulario.php");

$db = new mod_db();

$tolog = false;

if (isset($_POST["tolog"])) {
    $tolog = $_POST["tolog"];
}

if (isset($tolog) && $tolog == "true" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $Usuario = $_POST['usuario'];
    $ClaveKey = $_POST['contrasena'];
    $ipRemoto = $_SERVER['REMOTE_ADDR'];

    $Logearme = new ValidacionLogin($Usuario, $ClaveKey, $ipRemoto, $db);

    if ($Logearme->logger()) {
        $Logearme->autenticar();

        if ($Logearme->getIntentoLogin()) {
            $_SESSION['autenticado'] = "SI";
            $_SESSION['Usuario'] = $Logearme->getUsuario();

            $Logearme->registrarIntentos();
            $tolog = false;

            redireccionar("Usuarios/usuario.php");
        } else {
            $Logearme->registrarIntentos();
            $_SESSION["emsg"] = 1;
            redireccionar("login.php");
        }
    } else {
        $_SESSION["emsg"] = 1;
        redireccionar("login.php");
    }
} else {
    redireccionar("login.php");
}
?>
