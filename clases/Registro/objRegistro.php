<?php

require_once(__DIR__ . "/../conexion.php");
require_once("../logger.php");

class RegistroUsuario
{
    private $db;
    private $datos = [];
    private $rol;

    public function __construct($db, $rol, $datos = [])
    {
        $this->db = $db;
        $this->rol = $rol;
        $this->datos = $datos;
    }

    public function procesarFormulario()
    {
        if (empty($this->datos)) {
            Logger::warning("Intento de registro sin datos sanitizados.");
            return false;
        }

        Logger::info("Procesando registro para el usuario: " . ($this->datos['usuario'] ?? 'N/D'));

        $resultado = $this->db->insertSeguro('usuarios', $this->datos);

        if ($resultado) {
            $this->datos['id_usuario'] = $this->db->getConexion()->lastInsertId();

            $roldatos = [
                'id_usuario' => $this->datos['id_usuario'],
                'id_rol' => $this->rol
            ];

            Logger::info("ARREGLO DE ROL INSERT " . json_encode($roldatos));

            $this->db->insertSeguro('usuarios_roles', $roldatos);
            $this->db->registrarTrazabilidad("usuarios_rol", "Insertar Rol", $this->datos['id_usuario'], $this->datos['usuario']);

            Logger::info("Usuario registrado exitosamente con ID: " . $this->datos['id_usuario']);

            $this->db->registrarTrazabilidad(
                'usuarios',
                'INSERT',
                $this->datos['id_usuario'],
                $this->datos['usuario']
            );
        } else {
            Logger::error("Error al registrar el usuario: " . ($this->datos['usuario'] ?? 'N/D'));
        }

        return $resultado;
    }

    public function getDatos()
    {
        return $this->datos;
    }
}
