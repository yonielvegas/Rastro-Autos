<?php
require_once('../clases/conexion.php');
require_once('../clases/logger.php');

class Carrito {
    private $db;

    public function __construct() {
        $this->db = new mod_db();
    }

    public function agregar($id_usuario, $id_parte, $cantidad) {
        if (!$id_usuario || !$id_parte) {
            return ['ok' => false, 'msg' => 'Datos inválidos'];
        }
        logger::info("Intento EN CARRITO COMUNES de agregar al carrito: Usuario ID $id_usuario, Parte ID $id_parte, Cantidad $cantidad");

        if($cantidad < 1){
            $resultado = $this->db->eliminarProductoCarrito($id_usuario, $id_parte);
            logger::info("Carrito comunes Producto eliminado del carrito: Usuario ID $id_usuario, Parte ID $id_parte");
        }else{
            $resultado = $this->db->agregarcarrito($id_usuario, $id_parte, $cantidad);
            logger::info("Producto se envia a COnexion esta en Carrito: Usuario ID $id_usuario, Parte ID $id_parte, Cantidad $cantidad");
        }
        
        

        if ($resultado === true) {
            return ['ok' => true, 'msg' => 'Producto agregado al carrito'];
        }

        if (is_array($resultado) && isset($resultado['mensaje'])) {
            return ['ok' => false, 'msg' => $resultado['mensaje']];
        }

        return ['ok' => false, 'msg' => 'Error desconocido al agregar al carrito'];
    }
}
