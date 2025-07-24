<?php
require_once '../clases/conexion.php';
require_once '../clases/logger.php';

class SeccionController {
    private $db;
    private $id_seccion;    

    public function __construct($id_seccion) {
        $this->db = new mod_db();
        $this->id_seccion = $id_seccion;
    }

    public function getSecciones() {
        return $this->db->obtenerSeccion($this->id_seccion);
    }

    public function getMarcasPorSeccion($seccionId) {
        return $this->db->select("marcas", "*", "id_seccion = $seccionId");
    }

    public function getSeccion(){
        return $this->db->select("categoria", "categoria", "id_cat = " . $this->id_seccion);
    }
}