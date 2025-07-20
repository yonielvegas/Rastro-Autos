<?php

require_once("clases/logger.php"); // ✅ Asegúrate de que esta ruta sea correcta

class SanitizarEntrada {
    private $errores = [];
    private $db;

    public function __construct($db = null) {
        $this->db = $db;
    }

    public function getErrores() {
        return $this->errores;
    }

    public static function limpiarCadena($cadena) {
        if (empty($cadena)) {
            Logger::warning("Cadena vacía detectada en limpiarCadena.");
            return false;
        }

        return htmlspecialchars(strip_tags(trim($cadena)));
    }


    public function sanitizarTodo($post) {
        $datos = [];

        $nombre = $post['nombre'];
        $apellido = $post['apellido'];
        $usuario = $post['Usuario'];
        $correo = $post['correo'];
        $telefono = $post['telefono'];
        $contraseña = $post['password'];
        $contraseña2 = $post['password2'];


        // Nombre
        if (empty($nombre)) {
            $this->errores[] = "El nombre es obligatorio.";
            Logger::info("Falta el nombre en el formulario.");
        } else {
            $datos['Nombre'] = htmlspecialchars(strip_tags(trim($nombre)));
        }

        // Apellido
        if (empty($apellido)) {
            $this->errores[] = "El apellido es obligatorio.";
            Logger::info("Falta el apellido en el formulario.");
        } else {
            $datos['Apellido'] = htmlspecialchars(strip_tags(trim($apellido)));
        }

        // Usuario
        if (empty($usuario)) {
            $this->errores[] = "El usuario es obligatorio.";
            Logger::info("Falta el usuario.");
        } elseif (strlen($usuario) < 4) {
            $this->errores[] = "El usuario debe tener al menos 4 caracteres.";
            Logger::info("Usuario demasiado corto: " . $usuario);
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $usuario)) {
            $this->errores[] = "El usuario solo puede contener letras, números y guiones bajos.";
            Logger::info("Usuario con caracteres inválidos: " . $usuario);
        } elseif ($this->verificarDuplicado('usuario', $usuario)) {
            $this->errores[] = "Este Usuario ya está registrado.";
            Logger::info("Usuario duplicado: " . $usuario);
        } else {
            $datos['Usuario'] = htmlspecialchars(trim($usuario));
        }

        // Correo
        if (empty($correo)) {
            $this->errores[] = "El correo es obligatorio.";
            Logger::info("Falta el correo.");
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->errores[] = "Correo electrónico inválido.";
            Logger::info("Formato de correo inválido: " . $correo);
        } elseif ($this->verificarDuplicado('correo', $correo)) {
            $this->errores[] = "El correo ya está registrado.";
            Logger::info("Correo duplicado: " . $correo);
        } else {
            $datos['Correo'] = filter_var(trim($correo), FILTER_SANITIZE_EMAIL);
        }

        if(empty($telefono)){
            $this->errores[] = "El telefono es obligatorio";
            logger::info("Falta el Numero de Telefono");
        } elseif (!preg_match('/^\+?[0-9\s\-]{7,15}$/', $telefono)) {
            $this->errores[] = "El número de teléfono no es válido";
            logger::info("Número de teléfono inválido: $telefono");
        }elseif($this->verificarDuplicado('telefono', $telefono)){
            $this->errores[] = "Este Numero de Telefono ya fue registrado";
            logger::info("Número de teléfono inválido: $telefono");
        } else{
            $datos['telefono'] = $telefono;
        }


        // Password
        if($contraseña == $contraseña2){
            $this->errores[] = "Las contraseña no coinciden";
            Logger::info("Falta la contraseña.");
        }elseif (empty($contraseña)) {
            $this->errores[] = "La contraseña es obligatoria.";
            Logger::info("Falta la contraseña.");
        } elseif (strlen($contraseña) < 8) {
            $this->errores[] = "La contraseña debe tener al menos 8 caracteres.";
            Logger::info("Contraseña demasiado corta.");
        } elseif (!preg_match('/[A-Z]/', $contraseña)) {
            $this->errores[] = "La contraseña debe contener al menos una letra mayúscula.";
            Logger::info("Contraseña sin mayúsculas.");
        } elseif (!preg_match('/[@\-_]/', $contraseña)) {
            $this->errores[] = "La contraseña debe contener al menos uno de los siguientes caracteres: @, - o _.";
            Logger::info("Contraseña sin caracteres especiales.");
        } else {
            $passwordLimpia = htmlspecialchars(trim($contraseña));
            $datos['HashMagic'] = password_hash($passwordLimpia, PASSWORD_DEFAULT);
        }

        //retornar los datos sanitizados
        return $datos;
    }

    private function verificarDuplicado($columna, $valor) {
        if (!$this->db) return false;

        $valor = addslashes(trim($valor));
        $condicion = "$columna = '$valor'";
        $resultados = $this->db->select('usuarios', $columna, $condicion);

        if (!empty($resultados)) {
            Logger::debug("Duplicado detectado en $columna: $valor");
        }

        return !empty($resultados);
    }
}
