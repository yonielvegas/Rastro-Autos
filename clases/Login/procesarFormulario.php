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
    private $rol;
    private $errores = [];

    public function __construct($Usuario, $ClaveKey, $ipRemoto, $db) {
        $this->db = $db;

        $sanitizar = new SanitizarEntrada();

        $this->usuario = $sanitizar->limpiarCadena($Usuario);
        $this->password = $sanitizar->limpiarCadena($ClaveKey);
        $this->ip = $ipRemoto;

    }

    public function getErrores() {
        return $this->errores;
    }

    private function generarHash() {
        $options = ['cost' => 13];
        return password_hash($this->password, PASSWORD_BCRYPT, $options);
    }

    public function logger() {
        $usuariologueado = $this->db->log($this->usuario);

        $hashTemporal = $this->generarHash();
        Logger::info("Hash temporal generado para pruebas: $hashTemporal");

        if ($usuariologueado) {
            $this->id = $usuariologueado->id_usuario ?? null;
            $this->hastGenerado = $usuariologueado->password ?? null;

            // Asegúrate que id_usuario sea un número entero
            $idUsuario = (int) $this->id;

            $rolResult = $this->db->select("usuarios_roles", "id_rol", "id_usuario = $idUsuario");
            
            // Verificar y extraer el valor directamente
            if (!empty($rolResult) && isset($rolResult[0]['id_rol'])) {
                $this->rol = $rolResult[0]['id_rol'];
                Logger::info("ROL del usuario con ID $idUsuario es: {$this->rol}");
            } else {
                Logger::warning("No se encontró rol para el usuario con ID: $idUsuario");
                $this->errores[] = "Error Datos del Usuario Incompletos";
                $this->rol = null;
            }


            Logger::info("Usuario encontrado en base de datos: $this->usuario");
            return true;
        } else {
            $this->errores[] = "Usuario o Contraseña Incorrectos";
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
            $this->errores[] = "Usuario o Contraseña Incorrectos";
            $this->loginExitoso = 0;
        }
    }

    public function getIdUsuario() {
        return $this->id;
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

    public function getRol(){
        return $this->rol;
    }



    public function registrarIntentos($action) {
        $intentosbd = $this->db->select("usuario_intentos", "intentos, bloqueado", "id_usuario = $this->id");
        $bloqueado = $intentosbd[0]['bloqueado'];
        if (!$intentosbd) {
            $data = array(
                "id_usuario" => $this->id,
                "intentos" => 0,
                "bloqueado"  => 0
            );
            $this->db->insertSeguro("usuario_intentos", $data);
        }

        if(!$bloqueado){
            if ($action == 1) {
                $data = array(
                    "intentos" => 0,
                    "bloqueado"  => 0
                );

                // ✅ Array de condiciones
                $this->db->updateSeguro("usuario_intentos", $data, ["id_usuario" => $this->id]);

            } elseif ($action == 0) {
                if ($intentosbd[0]['intentos'] < 3) {
                    $intentosnuevo = $intentosbd[0]['intentos'] + 1;

                    $data = array(
                        "intentos" => $intentosnuevo
                    );

                    $this->db->updateSeguro("usuario_intentos", $data, ["id_usuario" => $this->id]);

                } elseif ($intentosbd[0]['intentos'] >= 3) {

                    $data = array(
                        "bloqueado" => 1
                    );

                    $this->db->updateSeguro("usuario_intentos", $data, ["id_usuario" => $this->id]);
                    header("Location: /Rastro-YPan.YSamaniego/login.php");
                    exit;
                }
            }
        }elseif ($bloqueado){
            Logger::warning("Intento de login para usuario bloqueado: $this->usuario");
            $this->errores[] = "Este Usuario Está Bloqueado";
            header("Location: /Rastro-YPan.YSamaniego/login.php");
        }

        // Registrar trazabilidad
        $accion = $this->loginExitoso ? "Select LOGIN_OK" : "Select LOGIN_FAIL";
        $this->db->registrarTrazabilidad("usuario_intentos", $accion, $this->id, $this->usuario);
        Logger::info("Intento de login registrado para el usuario: $this->usuario ID : $this->id con resultado: $this->loginExitoso");
    }

}
?>