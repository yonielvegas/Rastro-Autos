<?php
require_once '../clases/conexion.php';

$db = new mod_db();

$id = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$usuario = trim($_POST['usuario'] ?? '');
$rol = isset($_POST['rol']) ? intval($_POST['rol']) : null;
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';

// Validaciones (igual que antes)
if (!$nombre || !$apellido || !$correo || !$telefono || !$usuario) {
    die('Todos los campos obligatorios deben estar llenos.');
}
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die('Correo electrónico no válido.');
}
if ($id == 0 && !$rol) {
    die('Debe seleccionar un rol para el nuevo usuario.');
}
if ($password !== $password2) {
    die('Las contraseñas no coinciden.');
}

$hashedPassword = null;
if ($password !== '') {
    if (strlen($password) < 8) {
        die('La contraseña debe tener al menos 8 caracteres.');
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
}

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
    $where = ['id_usuario' => $id];
    $result = $db->updateSeguro("usuarios", $fields, $where);
    if (!$result) {
        die('Error al actualizar el usuario.');
    }
    // Actualizar rol en usuarios_roles
    if ($rol) {
        // Por ejemplo, borramos roles previos y asignamos nuevo rol
        $db->query("DELETE FROM usuarios_roles WHERE id_usuario = ?", [$id]);
        $db->insertSeguro("usuarios_roles", [
            'id_usuario' => $id,
            'id_rol' => $rol,
        ]);
    }
} else {
    // Insertar nuevo usuario
    if (!$hashedPassword) {
        die('La contraseña es obligatoria para un nuevo usuario.');
    }
    $data = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo,
        'telefono' => $telefono,
        'usuario' => $usuario,
        'password' => $hashedPassword,
        'activo' => 1,
    ];
    $result = $db->insertSeguro("usuarios", $data);
    if (!$result) {
        die('Error al crear el usuario.');
    }
    // Obtener último id insertado
    $newUserId = $db->lastInsertId(); // Depende de tu clase mod_db, adapta si no existe
    
    // Insertar rol
    if ($rol) {
        $db->insertSeguro("usuarios_roles", [
            'id_usuario' => $newUserId,
            'id_rol' => $rol,
        ]);

        // Si el rol es Operativo (id_rol = 2), insertar permiso especial
        if ($rol === 2) {
            $db->insertSeguro("permisos_usuarios", [
                'id_usuario' => $newUserId,
                'id_permiso' => 1,
            ]);
        }
    }
}

header("Location: usuario.php");
exit();
