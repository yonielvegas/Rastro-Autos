<?php
require_once '../clases/conexion.php'; // Conexión a base de datos

// Conectarse a la base de datos
$db = new mod_db();

// Recoger datos del formulario
$id = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';

// Validación básica
if (empty($nombre) || empty($apellido) || empty($correo) || empty($telefono) || empty($usuario)) {
    die('Todos los campos obligatorios deben estar llenos.');
}

if ($password !== $password2) {
    die('Las contraseñas no coinciden.');
}

// Solo hashear si se ingresó una nueva contraseña
$hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null;

if ($id > 0) {
    // Actualizar usuario
    $fields = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo,
        'telefono' => $telefono,
        'usuario' => $usuario,
    ];

    if ($hashedPassword) {
        $fields['password'] = $hashedPassword;
    }

    $db->updateSeguro("usuarios", $fields, ['id_usuario' => $id]);
    
} else {
    // Insertar nuevo usuario
    if (!$hashedPassword) {
        die('La contraseña es obligatoria para un nuevo usuario.');
    }

    $db->insertSeguro("usuarios", [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo,
        'telefono' => $telefono,
        'usuario' => $usuario,
        'password' => $hashedPassword,
        'activo' => 1 // Por defecto activo
    ]);
}

// Redirigir de vuelta a la lista o mostrar éxito
header("Location: usuario.php");
exit();
