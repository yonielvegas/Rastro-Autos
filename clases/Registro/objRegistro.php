<?php

require_once("conexion.php");
require_once("logger.php"); // ✅ Asegúrate de que la ruta sea correcta

class RegistroUsuario
{
    private $db;
    private $datos = [];

    public function __construct($db, $datos = [])
    {
        $this->db = $db;
        $this->datos = $datos;
    }

    public function procesarFormulario()
    {
        if (empty($this->datos)) {
            Logger::warning("Intento de registro sin datos sanitizados.");
            return false;
        }

        Logger::info("Procesando registro para el usuario: " . ($this->datos['Usuario'] ?? 'N/D'));

        $resultado = $this->db->insertSeguro('usuarios', $this->datos);

        if ($resultado) {
            $this->datos['id'] = $this->db->getConexion()->lastInsertId();
            Logger::info("Usuario registrado exitosamente con ID: " . $this->datos['id']);
            // Registrar trazabilidad
            $this->db->registrarTrazabilidad(
            'usuarios',
            'INSERT',
            $this->datos['id'],
            $this->datos['Usuario']
        );

   
        } else {
            Logger::error("Error al registrar el usuario: " . ($this->datos['Usuario'] ?? 'N/D'));
        }

        return $resultado;
    }

    public function getDatos()
    {
        return $this->datos;
    }
}
