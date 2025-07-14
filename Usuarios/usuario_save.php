<?php
// Asegúrate de que la ruta a conexion.php sea correcta
require_once("../clases/conexion.php");
$db = new mod_db();
session_start();

// Sanitizar los datos de entrada para prevenir inyecciones y XSS
function limpiar($valor) {
    return trim(htmlspecialchars($valor));
}

// Inicializa id_usuario. Asegura que sea un string limpio.
$id_usuario = $_POST['id_usuario'] ?? '';
if (is_array($id_usuario)) {
    $id_usuario = reset($id_usuario); // Tomar el primer valor si es un array inesperadamente
}
$id_usuario = limpiar($id_usuario);

// Obtener y limpiar todos los datos del formulario
$nombreCompleto = limpiar($_POST['nombre'] ?? '');
$email          = limpiar($_POST['email'] ?? '');
$usuario        = limpiar($_POST['usuario'] ?? '');
$telefono       = limpiar($_POST['telefono'] ?? '');
$password       = $_POST['password'] ?? ''; // La contraseña no se limpia para permitir caracteres especiales
$password2      = $_POST['password2'] ?? '';
$rol            = (int) ($_POST['rol'] ?? 0);
$activo         = (int) ($_POST['activo'] ?? 1);

// Determinar si es un nuevo registro o una edición
$esNuevo = empty($id_usuario);
$errores = []; // Array para acumular mensajes de error

// --- VALIDACIONES DE ENTRADA ---

// Validar nombre completo
if (empty($nombreCompleto)) {
    $errores[] = "El nombre completo está vacío.";
    $nombre = '';
    $apellido = '';
} else {
    // Separar nombre y apellido (toma la primera palabra como nombre, el resto como apellido)
    $nombres = explode(' ', $nombreCompleto, 2);
    $nombre = $nombres[0];
    $apellido = isset($nombres[1]) ? $nombres[1] : '';
}

// Validar correo electrónico
if (empty($email)) {
    $errores[] = "El correo es obligatorio.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Correo electrónico inválido.";
}

// Validar que el nombre de usuario no exista ya en la base de datos
try {
    $sqlUsuario = "SELECT id_usuario FROM usuarios WHERE usuario = :usuario";
    $paramsUsuario = [':usuario' => $usuario];

    if (!$esNuevo) {
        // Excluir al propio usuario si es una edición
        $sqlUsuario .= " AND id_usuario != :id_usuario";
        $paramsUsuario[':id_usuario'] = $id_usuario;
    }

    $stmtUsuario = $db->getConexion()->prepare($sqlUsuario);
    $stmtUsuario->execute($paramsUsuario);
    $existeUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

    if ($existeUsuario) {
        $errores[] = "Ya existe un usuario con ese nombre de usuario.";
    }
} catch (PDOException $e) {
    $errores[] = "Error al verificar nombre de usuario: " . $e->getMessage();
}

// Validar que el correo no exista ya en la base de datos
try {
    $sqlCheck = "SELECT id_usuario FROM usuarios WHERE correo = :correo";
    $paramsCheck = [':correo' => $email];

    if (!$esNuevo) {
        // Excluir al propio usuario si es una edición
        $sqlCheck .= " AND id_usuario != :id_usuario";
        $paramsCheck[':id_usuario'] = $id_usuario;
    }

    $stmt = $db->getConexion()->prepare($sqlCheck);
    $stmt->execute($paramsCheck);
    $existe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existe) {
        $errores[] = "Ya existe un usuario con ese correo.";
    }
} catch (PDOException $e) {
    $errores[] = "Error al verificar correo: " . $e->getMessage();
}

$passwordHash = null;
// Validar contraseñas si es un nuevo registro O si se proporcionaron contraseñas para actualizar
if ($esNuevo || (!empty($password) || !empty($password2))) {
    if (strlen($password) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }
    if ($password !== $password2) {
        $errores[] = "Las contraseñas no coinciden.";
    }
    // Si no hay errores específicos de contraseña y las contraseñas cumplen el mínimo y coinciden, hashear.
    // Esto previene hashear si hay errores previos no relacionados con la contraseña.
    if (empty($errores) || (strlen($password) >= 8 && $password === $password2)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }
}

// --- MANEJO DE ERRORES Y REDIRECCIÓN ---
if (!empty($errores)) {
    // Si hay errores, guardar en sesión para mostrarlos en el modal
    $_SESSION['errores_usuario'] = $errores;
    $_SESSION['abrir_modal'] = true; // Indicar que el modal debe abrirse
    $_SESSION['es_edicion'] = !empty($id_usuario); // Mantener el estado de edición
    $_SESSION['form_data'] = [ // Guardar los datos enviados para rellenar el formulario
        'id'       => $id_usuario,
        'nombre'   => $nombreCompleto,
        'usuario'  => $usuario,
        'telefono' => $telefono,
        'email'    => $email,
        'rol'      => $rol,
        'activo'   => $activo
    ];
    $_SESSION['redireccion_por_error'] = true; // Bandera para indicar que la redirección es por error
    header("Location: usuario.php"); // Redirección limpia
    exit;
}

// --- PROCESO DE GUARDADO/ACTUALIZACIÓN (SI NO HAY ERRORES) ---

// Si no hay errores, limpiar las variables de sesión del modal para asegurar que no se reabra
unset($_SESSION['redireccion_por_error']);
unset($_SESSION['errores_usuario']);
unset($_SESSION['abrir_modal']);
unset($_SESSION['es_edicion']);
unset($_SESSION['form_data']);

// Preparar los datos para la inserción/actualización
$datos = [
    'nombre'   => $nombre,
    'apellido' => $apellido,
    'correo'   => $email,
    'telefono' => $telefono,
    'usuario'  => $usuario,
    'activo'   => $activo,
    'id_rol'   => $rol
];

// Solo añadir la contraseña al array de datos si fue proporcionada y hasheada
if (!empty($passwordHash)) {
    $datos['password'] = $passwordHash;
}

// Realizar la operación en la base de datos
if ($esNuevo) {
    $resultado = $db->insertSeguro("usuarios", $datos);
    $_SESSION['mensaje_exito'] = $resultado ? "Usuario registrado exitosamente." : "Error al guardar el nuevo usuario.";
} else {
    // Si la contraseña no se envió para actualización, no la incluyas en el array de datos de actualización
    if (empty($password) && empty($password2)) { // Si ambos campos de contraseña están vacíos en edición
        unset($datos['password']); // No actualizar el campo de contraseña en la BD
    }
    $resultado = $db->updateSeguro("usuarios", $datos, ['id_usuario' => $id_usuario]);
    $_SESSION['mensaje_exito'] = $resultado ? "Usuario actualizado correctamente." : "Error al actualizar el usuario.";
}

// Redirigir a la página principal de usuarios después de procesar
header("Location: usuario.php"); // Redirección limpia
exit;
?>