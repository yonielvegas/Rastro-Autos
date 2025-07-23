<?php
require_once ("logger.php");
require_once 'ICRUD.php';

class mod_db implements ICRUD
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


	public function obtenerProducto($id_parte)
	{
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
			pa.imagen_thumbnail,
			ca.categoria,
			ma.marca,
			mo.modelo,
			mo.anio
			FROM partes_autos AS pa
			INNER JOIN categoria AS ca ON pa.id_cat = ca.id_cat
			INNER JOIN marca AS ma ON pa.id_marca = ma.id_marca
			INNER JOIN modelo AS mo ON pa.id_modelo = mo.id_modelo
			WHERE pa.id_parte = :id_parte";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			Logger::info("Intento de Registrar Trazabilidad: " . json_encode($result));
			return $result;	
		} catch (PDOException $e) {
			echo "Error al obtener producto: " . $e->getMessage();
			return false;
		}
	}

	public function stockproducto($id_parte){
		try {
			$sql = "SELECT cantidad_stock, precio FROM partes_autos WHERE id_parte = :id_parte";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result ?: ['cantidad_stock' => 0, 'precio' => 0];
		} catch (PDOException $e) {
			echo "Error al obtener stock y precio del producto: " . $e->getMessage();
			return false;
		}
	}


	public function agregarcarrito($id_usuario, $id_parte, $cantidad){
		Logger::info("EN CONEXION Intento de agregar al carrito: Usuario ID $id_usuario, Parte ID $id_parte, Cantidad $cantidad");

		// Verificar si hay stock suficiente
		$existecant = $this->stockproducto($id_parte);
		if ($existecant['cantidad_stock'] > $cantidad) {

			// Obtener todas las partes en el carrito del usuario
			$sql = "SELECT * FROM parte_vendida WHERE id_usuario = :id_usuario AND en_carrito = 1;";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->execute();
			$carrousuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// Verificar si ya tiene el producto en el carrito
			$partesEnCarrito = array_column($carrousuario, 'id_parte');
			if (in_array($id_parte, $partesEnCarrito)) {
				// Obtener la factura de esa parte
				foreach ($carrousuario as $item) {
					if ($item['id_parte'] == $id_parte) {
						$id_factura = $item['id_factura'];
						break;
					}
				}

				// Actualizar cantidad y precio_total
				$cantidad_actual = $cantidad;
				$precio_total = $existecant['precio'] * $cantidad_actual;

				$sql = "UPDATE parte_vendida SET cantidad = :cantidad, precio_total = :precio_total 
						WHERE id_usuario = :id_usuario AND id_parte = :id_parte AND en_carrito = 1 AND id_factura = :id_factura";
				$stmt = $this->conexion->prepare($sql);
				$stmt->bindParam(':cantidad', $cantidad_actual, PDO::PARAM_INT);
				$stmt->bindParam(':precio_total', $precio_total, PDO::PARAM_STR);
				$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
				$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
				$stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);

				if ($stmt->execute()) {
					$sql = "UPDATE factura SET total_factura = :precio_total WHERE id_factura = :id_factura";
					$stmt = $this->conexion->prepare($sql);
					$stmt->bindParam(':precio_total', $precio_total, PDO::PARAM_STR);
					$stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
					$stmt->execute();

					$this->registrarTrazabilidad('parte_vendida', 'actualización', $id_parte, $id_usuario);
					Logger::info("✅ Producto con ID $id_parte actualizado en el carrito del usuario con ID $id_usuario.");
					return true;
				} else {
					Logger::error("❌ Error al actualizar el carrito para el producto con ID $id_parte.");
					return ['success' => false, 'mensaje' => 'Error al actualizar el carrito'];
				}
			}

			// Si no hay productos en el carrito o es un producto nuevo, crear factura si es necesario
			$id_factura = null;
			if (empty($carrousuario)) {
				$sql = "INSERT INTO factura (total_factura) VALUES (0)";
				$stmt = $this->conexion->prepare($sql);
				$stmt->execute();
				$id_factura = $this->conexion->lastInsertId();
			} else {
				// Si ya hay otros productos, usar la misma factura
				$id_factura = $carrousuario[0]['id_factura'];
			}

			// Agregar nuevo producto al carrito
			$precio_total = $existecant['precio'] * $cantidad;
			$sql = "INSERT INTO parte_vendida (id_factura, id_parte, id_usuario, cantidad, precio_total, en_carrito) 
					VALUES (:id_factura, :id_parte, :id_usuario, :cantidad, :precio_total, 1)";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
			$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
			$stmt->bindParam(':precio_total', $precio_total, PDO::PARAM_STR);

			if ($stmt->execute()) {
				// Actualizar total de factura
				$sql = "UPDATE factura SET total_factura = total_factura + :precio_total WHERE id_factura = :id_factura";
				$stmt = $this->conexion->prepare($sql);
				$stmt->bindParam(':precio_total', $precio_total, PDO::PARAM_STR);
				$stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
				$stmt->execute();

				// Registrar trazabilidad e insertar en stock
				$this->registrarTrazabilidad('parte_vendida', 'inserción', $id_parte, $id_usuario);

				$sql = "UPDATE partes_autos SET cantidad_stock = cantidad_stock - :cantidad WHERE id_parte = :id_parte";
				$stmt = $this->conexion->prepare($sql);
				$stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
				$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
				$stmt->execute();

				Logger::info("✅ Producto con ID $id_parte agregado al carrito del usuario con ID $id_usuario.");
				return true;
			} else {
				Logger::error("❌ Error al insertar el producto con ID $id_parte al carrito.");
				return ['success' => false, 'mensaje' => 'Error al insertar el producto en el carrito'];
			}

		} else {
			Logger::error("❌ Error al agregar al carrito: No hay suficiente stock para el producto con ID $id_parte.");
			return ['success' => false, 'mensaje' => 'No hay suficiente stock disponible'];
		}
	}


	public function obtenerCarrito($id_usuario){
		try {
			$sql = "SELECT pv.*, pa.nombre, pa.imagen_thumbnail, pa.precio, f.total_factura
					FROM parte_vendida AS pv
					INNER JOIN partes_autos AS pa ON pv.id_parte = pa.id_parte
					INNER JOIN factura AS f ON pv.id_factura = f.id_factura
					WHERE pv.id_usuario = :id_usuario AND pv.en_carrito = 1";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error al obtener el carrito: " . $e->getMessage();
			return false;
		}
	}

	public function obtenerFactura($id_usuario) {
		try {
			$sql = "SELECT f.*
					FROM factura AS f
					INNER JOIN parte_vendida AS pv ON f.id_factura = pv.id_factura
					WHERE pv.id_usuario = :id_usuario AND pv.en_carrito = 1
					LIMIT 1";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			logger::info("Intento de obtener factura para el usuario con ID $id_usuario: " . json_encode($result));
			return $result;
		} catch (PDOException $e) {
			echo "Error al obtener la factura: " . $e->getMessage();
			return false;
		}
	}

	public function eliminarProductoCarrito($id_usuario, $id_parte) {
		Logger::info("Se intentará eliminar el producto con ID $id_parte del carrito del usuario con ID $id_usuario.");
		
		try {
			// Obtener el ID de la factura y el precio total del producto
			$sql = "SELECT id_factura, precio_total FROM parte_vendida 
					WHERE id_usuario = :id_usuario AND id_parte = :id_parte AND en_carrito = 1";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
			$stmt->execute();
			$factura = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($factura) {
				$id_factura = $factura['id_factura'];
				$precio_total = $factura['precio_total'];

				// Eliminar el producto del carrito
				$sql = "DELETE FROM parte_vendida 
						WHERE id_usuario = :id_usuario AND id_parte = :id_parte AND en_carrito = 1";
				$stmt = $this->conexion->prepare($sql);
				$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
				$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);
				
				if ($stmt->execute()) {
					// Actualizar el total de la factura manualmente usando el precio obtenido
					$sql = "UPDATE factura 
							SET total_factura = total_factura - :precio_total 
							WHERE id_factura = :id_factura";
					$stmt = $this->conexion->prepare($sql);
					$stmt->bindParam(':precio_total', $precio_total);
					$stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
					
					if ($stmt->execute()) {
						Logger::info("Producto con ID $id_parte eliminado correctamente del carrito del usuario con ID $id_usuario.");
						return true;
					}
				}
			}

			Logger::error("❌ Error al eliminar el producto con ID $id_parte del carrito del usuario con ID $id_usuario.");
			return false;

		} catch (PDOException $e) {
			echo "Error al eliminar el producto del carrito: " . $e->getMessage();
			return false;
		}
	}

	public function contarProductosCarrito($id_usuario) {
		try {
			$sql = "SELECT SUM(cantidad) AS total FROM parte_vendida WHERE id_usuario = :id_usuario AND en_carrito = 1";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return intval($result['total'] ?? 0);
		} catch (PDOException $e) {
			echo "Error al contar productos del carrito: " . $e->getMessage();
			return 0;
		}
	}

	public function eliminarDelCarrito($id_usuario, $id_parte) {
		Logger::info("Intento de eliminar el producto con ID $id_parte del carrito del usuario con ID $id_usuario.");

		try {
			$sql = "DELETE FROM parte_vendida WHERE id_usuario = :id_usuario AND id_parte = :id_parte AND en_carrito = 1";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
			$stmt->bindParam(':id_parte', $id_parte, PDO::PARAM_INT);

			if ($stmt->execute()) {
				Logger::info("Producto con ID $id_parte eliminado correctamente del carrito del usuario con ID $id_usuario.");
				return true;
			} else {
				Logger::error("❌ Error al eliminar el producto con ID $id_parte del carrito del usuario con ID $id_usuario.");
				return false;
			}
		} catch (PDOException $e) {
			echo "Error al eliminar el producto del carrito: " . $e->getMessage();
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