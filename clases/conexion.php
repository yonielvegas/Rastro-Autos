<?php
require_once ("logger.php");

class mod_db
{
	private $conexion; // Conexión a la base de datos
	private $perpage = 5; // Cantidad de registros por página
	private $total;
	private $pagecut_query;
	private $debug = false; // Cambiado a false para mantener la configuración original

	public function __construct()
	{
		
		##### Setting SQL Vars #####
		$sql_host = "localhost";
		$sql_name = "rastro_autos";
		$sql_user = "yonielvegas";	
		$sql_pass = "elvamp_2415";

		$dsn = "mysql:host=$sql_host;dbname=$sql_name;charset=utf8";
		try {
			$this->conexion = new PDO($dsn, $sql_user, $sql_pass);
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($this->debug) {
				echo "Conexión exitosa a la base de datos<br>";
			}
		} catch (PDOException $e) {
			echo "Error de conexión: " . $e->getMessage();
			exit;
		}
	}

	public function getConexion (){

		return $this->conexion;
	}

	public function disconnect()
	{
		$this->conexion = null; // Cierra la conexión a la base de datos
	}

    public function select($tb_name, $cols, $condicion)
	{
		$sql = "SELECT $cols FROM $tb_name";
		if (!empty($condicion)) {
			$sql .= " WHERE $condicion";
		}

		try {
			$stmt = $this->conexion->query($sql);
			return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna los resultados como arreglo asociativo
		} catch (PDOException $e) {
			echo "Error al hacer SELECT: " . $e->getMessage();
			return false;
		}
	}

    public function insertSeguro($tb_name, $data)
	{
		$columns = implode(", ", array_keys($data));
		$placeholders = ":" . implode(", :", array_keys($data));

		$sql = "INSERT INTO $tb_name ($columns) VALUES ($placeholders)";

		try {
			$stmt = $this->conexion->prepare($sql);

			// Asignar valores con bind
			foreach ($data as $key => $value) {
				$stmt->bindValue(":$key", $value);
			}

			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			echo "Error en INSERT: " . $e->getMessage();
			Logger::error("Error al insertar en $tabla: " . $e->getMessage());
			return false;
		}
	}

    public function updateSeguro($tabla, $data, $condiciones) {
		// Construir partes de SET dinámicamente
		$set = [];
		foreach ($data as $key => $value) {
			$set[] = "$key = :$key";
		}
		$setSQL = implode(", ", $set);

		// Construir partes de WHERE dinámicamente
		$where = [];
		foreach ($condiciones as $key => $value) {
			$where[] = "$key = :cond_$key";
		}
		$whereSQL = implode(" AND ", $where);
		$sql = "UPDATE $tabla SET $setSQL WHERE $whereSQL";

		try {
			$stmt = $this->conexion->prepare($sql);

			// Bind de los datos a actualizar
			foreach ($data as $key => $value) {
				$stmt->bindValue(":$key", $value);
			}

			// Bind de las condiciones (prefijadas con "cond_")
			foreach ($condiciones as $key => $value) {
				$stmt->bindValue(":cond_$key", $value);
			}

			return $stmt->execute();
		} catch (PDOException $e) {
			echo "Error en UPDATE: " . $e->getMessage();
			return false;
		}
	} // fin del update

	public function log($Usuario){

	 // Preparar la consulta

		 try {
		 $sql = "SELECT * FROM usuarios WHERE usuario = :User";
		 $stmt = $this->conexion->prepare($sql);
		 $stmt->bindParam(':User', $Usuario, PDO::PARAM_STR);

		 // Ejecutar la consulta
		 $stmt->execute();

			// Retornar el objeto directamente
            return $stmt->fetchObject();
		
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
            return null;
		}

	} 


	public function partes($marca, $modelo, $offset = null, $limit = null)
	{
		$params = [];
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
			pa.imagen_thumbnail,
			ca.categoria
			FROM partes_autos AS pa
			INNER JOIN categoria AS ca ON pa.id_cat = ca.id_cat";
		if (!empty($marca) && !empty($modelo)) {
			$sql .= " WHERE pa.id_marca = :marca AND pa.id_modelo = :modelo";
			$params = [
				':marca' => $marca,
				':modelo' => $modelo
			];
		}
		if ($limit !== null) {
			$sql .= " LIMIT " . intval($limit);
			if ($offset !== null) {
				$sql .= " OFFSET " . intval($offset);
			}
		}
		try {
			$stmt = $this->conexion->prepare($sql);
			$stmt->execute($params);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$total_partes = $this->select("partes_autos", "COUNT(*) as total", "id_marca = '$marca' AND id_modelo = '$modelo'");
			$result['total'] = $total_partes[0]['total'] ?? 0;
			return $result;
		} catch (PDOException $e) {
			echo "Error al hacer SELECT: " . $e->getMessage();
			return false;
		}
	}


	public function registrarTrazabilidad($tabla, $accion, $codigoRegistro, $usuario) {
        $fechaSistema = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? gethostbyname(gethostname()) ?? 'IP_NO_DETECTADA';

        $traza = [
            'tabla_afectada' => $tabla,
            'accion' => $accion,
            'id_usuario' => $codigoRegistro,
            'usuario' => $usuario,
            'ip_usuario' => $ip
        ];

		Logger::info("Intento de Registrar Trazabilidad: " . json_encode($traza));


        if (!$this->insertSeguro('trazabilidad', $traza)) {
            Logger::error("❌ Error al registrar trazabilidad de $accion en '$tabla' para el usuario '$usuario'.", "ERROR");
        }
    }
}
?>