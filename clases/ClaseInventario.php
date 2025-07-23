<?php
require_once 'Conexion.php';

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
            pa.fecha_registro,
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
        echo "Error al obtener partes con paginación: " . $e->getMessage();
        return [];
    }
}
}
?>
