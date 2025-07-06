<?php
require_once("comunes/sanitizar.php");
require_once ("clases/logger.php");

class ValidacionLogin {

    
    private $id;
    private $usuario;
    private $password;
    private $hastGenerado;
    private $loginExitoso;
    private $ip;
    private $db;

    public function __construct($Usuario, $ClaveKey, $ipRemoto, $db) {
        $this->db = $db;

        $sanitizar = new SanitizarEntrada();

        $this->usuario = $sanitizar->limpiarCadena($Usuario);
        $this->password = $sanitizar->limpiarCadena($ClaveKey);
        $this->ip = $ipRemoto;

    }

    private function generarHash() {
        $options = ['cost' => 13];
        return password_hash($this->password, PASSWORD_BCRYPT, $options);
    }

    public function logger() {
        $usuariologueado = $this->db->log($this->usuario);

        // Ejemplo de uso del hash generado (si realmente lo necesitas aquí)
        $hashTemporal = $this->generarHash(); // ✅ Llamar como método del objeto
        Logger::info("Hash temporal generado para pruebas: $hashTemporal");

        if ($usuariologueado) {
            $this->id =  $usuariologueado->id_usuario ?? null;
            $this->hastGenerado =  $usuariologueado->password ?? null;
            Logger::info("Usuario encontrado en base de datos: $this->usuario");
            return true;
        } else {
            Logger::warning("Usuario no encontrado: $this->usuario");
            return false;
        }
    }


    public function autenticar() {
        Logger::info("Verificando contraseña: entrada: '$this->password' vs hash: '$this->hastGenerado'");

        if (password_verify($this->password, $this->hastGenerado)) {
            Logger::info("Login exitoso para el usuario: $this->usuario");
            echo 'Password is valid!';
            $this->loginExitoso = 1;
        } else {
            Logger::warning("Login fallido: contraseña incorrecta para el usuario: $this->usuario");
            echo 'Invalid password.';
            $this->loginExitoso = 0;
        }
    }


    public function getIntentoLogin() {
        return $this->loginExitoso;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    
    public function getContrasena() {
        return $this->password;
    }

    public function getHashGenerado() {
        return $this->hastGenerado;
    }



    public function registrarIntentos() {
        $data = array(
            "Usuario" => $this->usuario,
            "ipRemoto" => $this->ip,
            "deteccion_anomalia" => $this->loginExitoso
        );

        $this->db->insertSeguro("intentos_login", $data);

        // Obtener el ID insertado
        $idInsertado = $this->db->getConexion()->lastInsertId();

        // Registrar trazabilidad
        $accion = $this->loginExitoso ? "LOGIN_OK" : "LOGIN_FAIL";
        #$this->db->registrarTrazabilidad("intentos_login", $accion, $idInsertado, $this->usuario);

        Logger::info("Intento de login registrado para el usuario: $this->usuario con resultado: $this->loginExitoso");
    }
}
?>
