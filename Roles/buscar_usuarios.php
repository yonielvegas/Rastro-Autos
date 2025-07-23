<?php
require_once '../clases/conexion.php';
$db = new mod_db();

$termino = $_GET['term'] ?? '';
$termino = strtolower(trim($termino));

$condicion = "LOWER(CONCAT(u.nombre, ' ', u.apellido)) LIKE '%$termino%'";

$sql = "
    SELECT 
        u.id_usuario,
        CONCAT(u.nombre, ' ', u.apellido) AS nombre,
        r.nombre_rol AS rol,
        GROUP_CONCAT(DISTINCT p.nombre_permiso) AS permisos
    FROM usuarios u
    LEFT JOIN usuarios_roles ru ON u.id_usuario = ru.id_usuario
    LEFT JOIN roles r ON ru.id_rol = r.id_rol
    LEFT JOIN permisos_usuarios pu ON u.id_usuario = pu.id_usuario
    LEFT JOIN permisos p ON pu.id_permiso = p.id_permiso
    WHERE $condicion
      AND r.nombre_rol IN ('administrador', 'operativo')
    GROUP BY u.id_usuario
    LIMIT 10
";

try {
    $stmt = $db->getConexion()->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($usuarios);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al consultar: ' . $e->getMessage()]);
}