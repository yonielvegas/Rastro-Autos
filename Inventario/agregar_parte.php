<?php
require_once '../clases/conexion.php';

$db = new mod_db();
$conn = $db->getConexion();

// Recibir datos del formulario
$nombre = $_POST['nombre'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$anio = $_POST['anio'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$precio = $_POST['precio'] ?? 0;
$stock = $_POST['stock'] ?? 0;
$fecha = $_POST['fecha'] ?? date('Y-m-d');
$descripcion = $_POST['descripcion'] ?? '';

// Manejo de imagen
$directorio = "../imagenes/";
$nombreImagen = '';
$nombreThumbnail = '';

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['imagen']['tmp_name'];
    $nombreArchivo = uniqid('parte_') . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($tmp, $directorio . $nombreArchivo);
    $nombreImagen = $nombreArchivo;

    // También podrías generar una versión thumbnail aquí si lo deseas
    $nombreThumbnail = $nombreArchivo; // Simplificado
}

// Obtener IDs relacionados (marca, modelo, categoría)
$sqlMarca = "SELECT id_marca FROM marca WHERE LOWER(marca) = ?";
$sqlModelo = "SELECT id_modelo FROM modelo WHERE LOWER(modelo) = ?";
$sqlCat = "SELECT id_cat FROM categoria WHERE LOWER(categoria) = ?";

$idMarca = $conn->prepare($sqlMarca);
$idMarca->execute([strtolower($marca)]);
$id_marca = $idMarca->fetchColumn();

$idModelo = $conn->prepare($sqlModelo);
$idModelo->execute([strtolower($modelo)]);
$id_modelo = $idModelo->fetchColumn();

$idCategoria = $conn->prepare($sqlCat);
$idCategoria->execute([strtolower($categoria)]);
$id_cat = $idCategoria->fetchColumn();

// Insertar en la tabla
$sql = "INSERT INTO partes_autos (nombre, descripcion, precio, cantidad_stock, codigo_serie, id_marca, id_modelo, id_cat, fecha_registro, imagen, imagen_thumbnail)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$resultado = $stmt->execute([
    $nombre, $descripcion, $precio, $stock, $codigo,
    $id_marca, $id_modelo, $id_cat, $fecha,
    $nombreImagen, $nombreThumbnail
]);

echo $resultado ? "OK" : "ERROR";
