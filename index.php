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
}

if (isset($tolog) && $tolog == "true" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $Usuario = $_POST['usuario'];
    $ClaveKey = $_POST['contrasena'];
    $ipRemoto = $_SERVER['REMOTE_ADDR'];

    $Logearme = new ValidacionLogin($Usuario, $ClaveKey, $ipRemoto, $db);
    
    if ($Logearme->logger()) {
        $Logearme->autenticar();
        $rol = $Logearme->getRol();
        

        if ($Logearme->getIntentoLogin()) {
            $_SESSION['autenticado'] = "SI";
            $_SESSION['usuario'] = $Logearme->getUsuario();
            $Logearme->registrarIntentos(1);
            $tolog = false;

            $errores = $Logearme->getErrores();
            Logger::info("ERRORES DE BLOQUEO: " . json_encode($errores));
            if (!empty($errores)) {
                $_SESSION['errores_login'] = $errores;
            }


            if ($rol == 1 || $rol == 2) {
                $_SESSION['rol'] = $rol;
                redireccionar("Usuarios/usuario.php");
            } elseif ($rol == 3){
                $_SESSION['rol'] =$rol;
                redireccionar("public/listado_partes.php");
            }else{
                header("login.php");
            }
        }
        else {
            $Logearme->registrarIntentos(0);
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
