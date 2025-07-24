<?php
require_once '../clases/conexion.php';

header('Content-Type: application/json');

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

// Validaciones
if (!$nombre || !$apellido || !$correo || !$telefono || !$usuario) {
    echo json_encode(['status' => 'error', 'msg' => 'Todos los campos obligatorios deben estar llenos.']);
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'msg' => 'Correo electrónico no válido.']);
    exit;
}

// Validar que teléfono sea numérico (solo dígitos)
if (!ctype_digit($telefono)) {
    echo json_encode(['status' => 'error', 'msg' => 'El teléfono debe contener solo números.']);
    exit;
}

if ($id == 0 && !$rol) {
    echo json_encode(['status' => 'error', 'msg' => 'Debe seleccionar un rol para el nuevo usuario.']);
    exit;
}

// Validar que correo no exista (excluyendo usuario actual si es edición)
$queryCorreo = "SELECT COUNT(*) as total FROM usuarios WHERE correo = ?";
$paramsCorreo = [$correo];
if ($id > 0) {
    $queryCorreo .= " AND id_usuario != ?";
    $paramsCorreo[] = $id;
}
$resultCorreo = $db->queryEspecifico($queryCorreo, $paramsCorreo);
if ($resultCorreo && $resultCorreo[0]['total'] > 0) {
    echo json_encode(['status' => 'error', 'msg' => 'El correo electrónico ya está registrado.']);
    exit;
}

// Validar que usuario no exista (excluyendo usuario actual si es edición)
$queryUsuario = "SELECT COUNT(*) as total FROM usuarios WHERE usuario = ?";
$paramsUsuario = [$usuario];
if ($id > 0) {
    $queryUsuario .= " AND id_usuario != ?";
    $paramsUsuario[] = $id;
}
$resultUsuario = $db->queryEspecifico($queryUsuario, $paramsUsuario);
if ($resultUsuario && $resultUsuario[0]['total'] > 0) {
    echo json_encode(['status' => 'error', 'msg' => 'El nombre de usuario ya está en uso.']);
    exit;
}


$hashedPassword = null;
if ($password !== '') {
    if (strlen($password) < 8) {
        echo json_encode(['status' => 'error', 'msg' => 'La contraseña debe tener al menos 8 caracteres.']);
        exit;
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
        echo json_encode(['status' => 'error', 'msg' => 'Error al actualizar el usuario.']);
        exit;
    }
    // Actualizar rol en usuarios_roles
    if ($rol) {
        $db->query("DELETE FROM usuarios_roles WHERE id_usuario = ?", [$id]);
        $db->insertSeguro("usuarios_roles", [
            'id_usuario' => $id,
            'id_rol' => $rol,
        ]);
    }
    echo json_encode(['status' => 'success', 'msg' => 'Usuario actualizado correctamente.']);
    exit;
} else {
    // Insertar nuevo usuario
    if (!$hashedPassword) {
        echo json_encode(['status' => 'error', 'msg' => 'La contraseña es obligatoria para un nuevo usuario.']);
        exit;
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
        echo json_encode(['status' => 'error', 'msg' => 'Error al crear el usuario.']);
        exit;
    }
    $newUserId = $db->lastInsertId(); // Ajusta según tu clase mod_db
    
    if ($rol) {
        $db->insertSeguro("usuarios_roles", [
            'id_usuario' => $newUserId,
            'id_rol' => $rol,
        ]);
        if ($rol === 2) {
            $db->insertSeguro("permisos_usuarios", [
                'id_usuario' => $newUserId,
                'id_permiso' => 1,
            ]);
        }
    }
    echo json_encode(['status' => 'success', 'msg' => 'Usuario creado correctamente.']);
    exit;
}
