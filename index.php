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

            // Consultar si tiene secret_2fa
            $usuarioLogueado = $Logearme->getUsuario();
            $sql = "SELECT secret_2fa FROM usuarios WHERE Usuario = ?";
            $stmt = $db->getConexion()->prepare($sql);
            $stmt->execute([$usuarioLogueado]);
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            $Logearme->registrarIntentos();
            $tolog = false;

            if (!empty($fila['secret_2fa'])) {
                $_SESSION['pendiente_2fa'] = true;
                redireccionar("EjemploAutenticar.php");
            } else {
                redireccionar("formularios/PanelControl.php");
            }
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
