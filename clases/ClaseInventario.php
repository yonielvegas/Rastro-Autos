<?php
require_once 'conexion.php';

class Inventario {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConexion();
    }

    public function contarPartes() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM partes_autos");
        return (int)$stmt->fetchColumn();
    }

    public function obtenerPartesLimitOffset($limit, $offset) {
        try {
            $sql = "SELECT
                pa.id_parte,
                pa.nombre,
                pa.descripcion,
                pa.precio,
                pa.cantidad_stock,
                pa.codigo_serie,
                pa.id_marca,
                pa.id_modelo,
                pa.imagen,
                DATE(pa.fecha_registro) AS fecha_registro,
                pa.imagen_thumbnail,
                ca.categoria,
                ma.marca,
                mo.modelo,
                mo.anio
            FROM partes_autos AS pa
            INNER JOIN categoria AS ca ON pa.id_cat = ca.id_cat
            INNER JOIN marca AS ma ON pa.id_marca = ma.id_marca
            INNER JOIN modelo AS mo ON pa.id_modelo = mo.id_modelo
            ORDER BY pa.id_parte DESC
            LIMIT :limit OFFSET :offset";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en obtenerPartesLimitOffset: " . $e->getMessage());
            return [];
        }
    }
    public function agregarParte($nombre, $descripcion, $precio, $cantidad_stock, $codigo_serie, $id_marca, $id_modelo, $id_cat, $imagen, $imagen_thumbnail, $fecha_registro) {
        try {
            $sql = "INSERT INTO partes_autos (nombre, descripcion, precio, cantidad_stock, codigo_serie, id_marca, id_modelo, id_cat, imagen, imagen_thumbnail, fecha_registro) 
                    VALUES (:nombre, :descripcion, :precio, :cantidad_stock, :codigo_serie, :id_marca, :id_modelo, :id_cat, :imagen, :imagen_thumbnail, :fecha_registro)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':descripcion', $descripcion);
            $stmt->bindValue(':precio', $precio);
            $stmt->bindValue(':cantidad_stock', $cantidad_stock, PDO::PARAM_INT);
            $stmt->bindValue(':codigo_serie', $codigo_serie);
            $stmt->bindValue(':id_marca', $id_marca, PDO::PARAM_INT);
            $stmt->bindValue(':id_modelo', $id_modelo, PDO::PARAM_INT);
            $stmt->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
            $stmt->bindValue(':imagen', $imagen); // Aquí se enlaza la ruta de la imagen original
            $stmt->bindValue(':imagen_thumbnail', $imagen_thumbnail); // Aquí se enlaza la ruta del thumbnail
            $stmt->bindValue(':fecha_registro', $fecha_registro);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al agregar parte: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarParte($id_parte) {
        try {
            $sql = "DELETE FROM partes_autos WHERE id_parte = :id_parte";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_parte', (int)$id_parte, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // En un entorno de producción, es mejor registrar el error en un log
            // y no mostrarlo directamente al usuario por seguridad.
            echo "Error al eliminar parte: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerTodosLosModelos() {
        try {
            $sql = "SELECT id_modelo, modelo, id_marca FROM modelo";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener modelos: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerTodasLasMarcas() {
        try {
            $stmt = $this->db->query("SELECT id_marca, marca FROM marca");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener marcas: " . $e->getMessage();
            return [];
        }
    }


    public function obtenerPartePorId($id_parte) {
        try {
            $sql = "SELECT
                pa.id_parte,
                pa.nombre,
                pa.descripcion,
                pa.precio,
                pa.cantidad_stock,
                pa.codigo_serie,
                pa.imagen,
                pa.imagen_thumbnail, -- Asegúrate de obtener la ruta de la miniatura también
                DATE(pa.fecha_registro) AS fecha_registro,
                ca.categoria,
                pa.id_cat, -- ¡Añadido!
                ma.marca,
                pa.id_marca, -- ¡Añadido!
                mo.modelo,
                pa.id_modelo, -- ¡Añadido!
                mo.anio
            FROM partes_autos AS pa
            INNER JOIN categoria AS ca ON pa.id_cat = ca.id_cat
            INNER JOIN marca AS ma ON pa.id_marca = ma.id_marca
            INNER JOIN modelo AS mo ON pa.id_modelo = mo.id_modelo
            WHERE pa.id_parte = :id_parte";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_parte', (int)$id_parte, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener parte por ID: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerModeloPorId($id_modelo) {
    try {
        $sql = "SELECT modelo, anio FROM modelo WHERE id_modelo = :id_modelo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_modelo', $id_modelo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en obtenerModeloPorId: " . $e->getMessage());
        return false;
    }
}

public function actualizarParte(
    $id_parte, $nombre, $descripcion, $precio, $cantidad_stock, 
    $codigo_serie, $id_marca, $id_modelo, $id_cat, 
    $imagen_original_path_db, $imagen_thumbnail_path_db, $fecha_registro
) {
    try {
        $sql = "UPDATE partes_autos SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    cantidad_stock = :cantidad_stock,
                    codigo_serie = :codigo_serie,
                    id_marca = :id_marca,
                    id_modelo = :id_modelo,
                    id_cat = :id_cat,
                    fecha_registro = :fecha_registro,
                    imagen = :imagen,
                    imagen_thumbnail = :imagen_thumbnail
                WHERE id_parte = :id_parte";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_parte', $id_parte, PDO::PARAM_INT);
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindValue(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindValue(':cantidad_stock', $cantidad_stock, PDO::PARAM_INT);
        $stmt->bindValue(':codigo_serie', $codigo_serie, PDO::PARAM_STR);
        $stmt->bindValue(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->bindValue(':id_modelo', $id_modelo, PDO::PARAM_INT);
        $stmt->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
        $stmt->bindValue(':fecha_registro', $fecha_registro, PDO::PARAM_STR);
        $stmt->bindValue(':imagen', $imagen_original_path_db, PDO::PARAM_STR);
        $stmt->bindValue(':imagen_thumbnail', $imagen_thumbnail_path_db, PDO::PARAM_STR);

        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error al actualizar parte: " . $e->getMessage());
        return false;
    }
}
}