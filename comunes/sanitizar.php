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

    public static function limpiarSecreto($secreto) {
        if (empty($secreto)) {
            Logger::warning("Secreto vacío en limpiarSecreto.");
            return false;
        }

        if (!preg_match('/^[A-Z2-7=]+$/', $secreto)) {
            Logger::warning("Secreto con formato inválido: $secreto");
            return false;
        }

        return htmlspecialchars(trim($secreto));
    }

    public function sanitizarTodo($post) {
        $datos = [];

        // Nombre
        if (empty($post['nombre'])) {
            $this->errores[] = "El nombre es obligatorio.";
            Logger::info("Falta el nombre en el formulario.");
        } else {
            $datos['Nombre'] = htmlspecialchars(strip_tags(trim($post['nombre'])));
        }

        // Apellido
        if (empty($post['apellido'])) {
            $this->errores[] = "El apellido es obligatorio.";
            Logger::info("Falta el apellido en el formulario.");
        } else {
            $datos['Apellido'] = htmlspecialchars(strip_tags(trim($post['apellido'])));
        }

        // Usuario
        if (empty($post['Usuario'])) {
            $this->errores[] = "El usuario es obligatorio.";
            Logger::info("Falta el usuario.");
        } elseif (strlen($post['Usuario']) < 4) {
            $this->errores[] = "El usuario debe tener al menos 4 caracteres.";
            Logger::info("Usuario demasiado corto: " . $post['Usuario']);
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $post['Usuario'])) {
            $this->errores[] = "El usuario solo puede contener letras, números y guiones bajos.";
            Logger::info("Usuario con caracteres inválidos: " . $post['Usuario']);
        } elseif ($this->verificarDuplicado('Usuario', $post['Usuario'])) {
            $this->errores[] = "Este Usuario ya está registrado.";
            Logger::info("Usuario duplicado: " . $post['Usuario']);
        } else {
            $datos['Usuario'] = htmlspecialchars(trim($post['Usuario']));
        }

        // Correo
        if (empty($post['correo'])) {
            $this->errores[] = "El correo es obligatorio.";
            Logger::info("Falta el correo.");
        } elseif (!filter_var($post['correo'], FILTER_VALIDATE_EMAIL)) {
            $this->errores[] = "Correo electrónico inválido.";
            Logger::info("Formato de correo inválido: " . $post['correo']);
        } elseif ($this->verificarDuplicado('Correo', $post['correo'])) {
            $this->errores[] = "El correo ya está registrado.";
            Logger::info("Correo duplicado: " . $post['correo']);
        } else {
            $datos['Correo'] = filter_var(trim($post['correo']), FILTER_SANITIZE_EMAIL);
        }

        // Password
        if (empty($post['password'])) {
            $this->errores[] = "La contraseña es obligatoria.";
            Logger::info("Falta la contraseña.");
        } elseif (strlen($post['password']) < 8) {
            $this->errores[] = "La contraseña debe tener al menos 8 caracteres.";
            Logger::info("Contraseña demasiado corta.");
        } elseif (!preg_match('/[A-Z]/', $post['password'])) {
            $this->errores[] = "La contraseña debe contener al menos una letra mayúscula.";
            Logger::info("Contraseña sin mayúsculas.");
        } elseif (!preg_match('/[@\-_]/', $post['password'])) {
            $this->errores[] = "La contraseña debe contener al menos uno de los siguientes caracteres: @, - o _.";
            Logger::info("Contraseña sin caracteres especiales.");
        } else {
            $passwordLimpia = htmlspecialchars(trim($post['password']));
            $datos['HashMagic'] = password_hash($passwordLimpia, PASSWORD_DEFAULT);
        }

        // Sexo
        $sexo = $post['sexo'] ?? '';
        if (!in_array($sexo, ['M', 'F'])) {
            $this->errores[] = "Sexo inválido.";
            Logger::info("Sexo inválido: $sexo");
        } else {
            $datos['Sexo'] = $sexo;
        }

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
