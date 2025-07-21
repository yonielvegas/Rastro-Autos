<?php
session_start();
include("../clases/conexion.php");
include("../comunes/sanitizar.php");

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== "SI") {
    header("Location: ../login.php");
    exit();
}

Logger::warning("Contenido completo de la sesión: " . print_r($_SESSION, true));


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
    echo "<script>alert('$mensaje');window.location.href='../Usuarios/usuario.php';</script>";
    exit();
}
?>