<?php
ini_set("memory_limit","256M");
ini_set('max_execution_time', '60');

require_once 'conexion.php'; 
require_once 'ClaseInventario.php';
require_once 'Thumbnail.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];
error_log("procesar_inventario.php: Script iniciado.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mod_db();
    $inventario = new Inventario($conexion);

    $action = $_POST['action'] ?? '';
    error_log("procesar_inventario.php: Acción recibida - " . $action);

    switch ($action) {
        case 'agregar':
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0.0;
    $cantidad_stock = $_POST['cantidad_stock'] ?? 0;
    $codigo_serie = $_POST['codigo_serie'] ?? '';
    $id_marca = $_POST['id_marca'] ?? 0;
    $id_modelo = $_POST['id_modelo'] ?? 0; // Este valor sí lo recibes del formulario
    $id_cat = $_POST['id_cat'] ?? 0;
    $fecha_registro = $_POST['fecha_registro'] ?? date('Y-m-d');
    
    $imagen_original_path_db = null;
    $imagen_thumbnail_path_db = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['imagen'];

        // Obtener el nombre del modelo y el año desde la base de datos usando el ID
        $modelo_data = $inventario->obtenerModeloPorId($id_modelo);
        $modelo = $modelo_data['modelo'] ?? 'modelo_desconocido';
        $anio = $modelo_data['anio'] ?? '0000';
        
        $nombre_parte_limpio = preg_replace('/[^a-z0-9_\-]/', '', str_replace(' ', '_', strtolower($nombre)));
        $modelo_limpio = preg_replace('/[^a-z0-9_\-]/', '', str_replace(' ', '_', strtolower($modelo)));
        $anio_limpio = preg_replace('/[^a-z0-9_\-]/', '', str_replace(' ', '_', strtolower($anio)));
        
        $baseFileName = $nombre_parte_limpio . '_' . $modelo_limpio . '_' . $anio_limpio;
        $originalFileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        $newFileName = $baseFileName . '.' . $originalFileExt;
        $thumbFileName = 'thumb_' . $newFileName;

        // RUTAS DE DIRECTORIOS CORREGIDAS
        $uploadDirOriginal = '../inventario/uploads/imagenes/';
        $uploadDirThumbnails = '../inventario/uploads/thumbnails/';

        if (!is_dir($uploadDirOriginal)) { mkdir($uploadDirOriginal, 0777, true); }
        if (!is_dir($uploadDirThumbnails)) { mkdir($uploadDirThumbnails, 0777, true); }

        $targetFilePathOriginal = $uploadDirOriginal . $newFileName;
        $targetFilePathThumbnail = $uploadDirThumbnails . $thumbFileName;
        
        $count = 1;
        while (file_exists($targetFilePathOriginal)) {
            $newFileName = $baseFileName . '_' . $count . '.' . $originalFileExt;
            $thumbFileName = 'thumb_' . $newFileName;
            $targetFilePathOriginal = $uploadDirOriginal . $newFileName;
            $targetFilePathThumbnail = $uploadDirThumbnails . $thumbFileName;
            $count++;
        }

        if (move_uploaded_file($file['tmp_name'], $targetFilePathOriginal)) {
            $imagen_original_path_db = 'uploads/imagenes/' . $newFileName; 
            
            $thumbnailer = new thumImagenes();
            $thumbnailer->introduce_imagen($targetFilePathOriginal, $file['type'], 120); 

            if ($thumbnailer->crear_thumbnail($targetFilePathThumbnail)) {
                $imagen_thumbnail_path_db = 'uploads/thumbnails/' . $thumbFileName; 
            } else {
                $response['message'] = 'Error: Imagen subida, pero hubo un problema al crear el thumbnail.';
                if (file_exists($targetFilePathOriginal)) { unlink($targetFilePathOriginal); }
                echo json_encode($response);
                exit();
            }
        } else {
            $response['message'] = 'Error al subir la imagen principal.';
            echo json_encode($response);
            exit();
        }
    } else if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
        $response['message'] = 'Error en la subida del archivo. Código de error de PHP: ' . $_FILES['imagen']['error'];
        echo json_encode($response);
        exit();
    }

    if ($inventario->agregarParte($nombre, $descripcion, $precio, $cantidad_stock, $codigo_serie, $id_marca, $id_modelo, $id_cat, $imagen_original_path_db, $imagen_thumbnail_path_db, $fecha_registro)) {
        $response['success'] = true;
        $response['message'] = 'Parte agregada exitosamente.';
    } else {
        $response['message'] = 'Error al agregar la parte en la base de datos. Verifique logs.';
        if ($imagen_original_path_db && file_exists('../inventario/' . $imagen_original_path_db)) {
            unlink('../inventario/' . $imagen_original_path_db);
        }
        if ($imagen_thumbnail_path_db && file_exists('../inventario/' . $imagen_thumbnail_path_db)) {
            unlink('../inventario/' . $imagen_thumbnail_path_db);
        }
    }
    break;

        case 'ver':
            $id_parte = $_POST['id_parte'] ?? 0;
            if ($id_parte > 0) {
                $parte = $inventario->obtenerPartePorId($id_parte);
                if ($parte) {
                    $response['success'] = true;
                    $response['message'] = 'Parte encontrada.';
                    $response['data'] = $parte;
                } else {
                    $response['message'] = 'Parte no encontrada.';
                }
            } else {
                $response['message'] = 'ID de parte inválido.';
            }
            break;

        case 'eliminar':
            $id_parte = $_POST['id_parte'] ?? 0;
            error_log("procesar_inventario.php: Acción 'eliminar' para ID: " . $id_parte);
            if ($id_parte > 0) {
                if ($inventario->eliminarParte($id_parte)) {
                    $response['success'] = true;
                    $response['message'] = 'Parte eliminada exitosamente.';
                } else {
                    $response['message'] = 'Error al eliminar la parte.';
                }
            } else {
                $response['message'] = 'ID de parte inválido para eliminar.';
            }
            break;

        default:
            $response['message'] = 'Acción no reconocida.';
            error_log("procesar_inventario.php: Acción no reconocida: " . $action);
            break;
    }
} else {
    $response['message'] = 'Método de solicitud no permitido.';
    error_log("procesar_inventario.php: Método de solicitud no permitido: " . $_SERVER['REQUEST_METHOD']);
}

echo json_encode($response);
error_log("procesar_inventario.php: Respuesta JSON enviada: " . json_encode($response));

?>