<?php
include("../clases/conexion.php");
include("../comunes/sanitizar.php");
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== "SI") {
    header("Location: ../login.php");
    exit();
}

Logger::warning("Contenido completo de la sesión EN CAMBIAR CONTRASEÑA: " . print_r($_SESSION, true));


$db = new mod_db();
$usuario = $_SESSION['usuario'];
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contrasena_actual = $_POST['pass_actual'] ?? '';
    $nueva_contrasena = $_POST['pass_nueva'] ?? '';

    if (empty($nueva_contrasena)) {
        $mensaje = "La nueva contraseña no puede estar vacía.";
    } else {
        // Obtener el hash de la contraseña actual
        $result = $db->select('usuarios', 'password', "usuario = " . $db->getConexion()->quote($usuario));
        if ($result && count($result) > 0) {
            $hash_actual = $result[0]['password'];
            if (password_verify($contrasena_actual, $hash_actual)) {
                // Actualizar la contraseña
                $nuevo_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
                $update = $db->updateSeguro(
                    'usuarios',
                    ['password' => $nuevo_hash],
                    ['usuario' => $usuario]
                );
                if ($update) {
                    $mensaje = "Contraseña cambiada exitosamente.";
                } else {
                    $mensaje = "Error al actualizar la contraseña.";
                }
            } else {
                $mensaje = "La contraseña actual es incorrecta.";
            }
        } else {
            $mensaje = "Usuario no encontrado.";
        }
    }
    $mensaje_limpio = htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');
    $tipo_alerta = ($mensaje === "Contraseña cambiada exitosamente.") ? "success" : "error";
    $titulo_alerta = ($mensaje === "Contraseña cambiada exitosamente.") ? "¡Éxito!" : "¡Error!";

    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Resultado</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: '$tipo_alerta',
                    title: '$titulo_alerta',
                    text: '$mensaje_limpio',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../Usuarios/usuario.php';
                });
            </script>
        </body>
        </html>";
        exit();


}
?>