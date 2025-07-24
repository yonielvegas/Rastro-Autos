<?php

// Manejar exportaciones ANTES de cualquier salida HTML
if (isset($_GET['exportar'])) {
    // Verificar si PhpSpreadsheet está disponible
    if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
        die("Error: PhpSpreadsheet no está instalado. Ejecuta 'composer require phpoffice/phpspreadsheet'");
    }
    
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../Seccion/controller_seccion.php';
    
    $controller = new SeccionController($_GET['seccion'] ?? '');
    
    try {
        if ($_GET['exportar'] == '1') {
            $controller->generarReporteExcel([
                'marca' => $_GET['marca'] ?? '',  // Cambiado de 'id_marca' a 'marca'
                'modelo' => $_GET['modelo'] ?? '', // Cambiado de 'id_modelo' a 'modelo'
                'orden' => $_GET['orden'] ?? ''
            ]);
        } elseif ($_GET['exportar'] == 'estadisticas') {
            $controller->generarEstadisticasExcel();
        }
    } catch (Exception $e) {
        die("Error al generar el reporte: " . $e->getMessage());
    }
    exit;
}

// Solo después de manejar exportaciones, incluir el resto
include '../comunes/navbar.php';
include '../comunes/sidebar.php';
require_once '../Seccion/controller_seccion.php';

// Inicializar variables
$seccion = $_GET['seccion'] ?? '';
$filtroMarca = $_GET['marca'] ?? '';
$filtroModelo = $_GET['modelo'] ?? '';
$orden = $_GET['orden'] ?? '';

$seccion = htmlspecialchars($seccion);
$filtroMarca = htmlspecialchars($filtroMarca);
$filtroModelo = htmlspecialchars($filtroModelo);
$orden = htmlspecialchars($orden);

// Marcas y modelos agrupados
$marcasModelos = [
  'Toyota' => ['Corolla', 'Rav4', 'Prado'],
  'Mazda' => ['CX-5', 'MX-5 Miata', 'CX-30'],
  'Ford'  => ['Mustang', 'Escape', 'F-150']
];

// Autoasignar marca si solo hay modelo
if ($filtroMarca === '' && $filtroModelo !== '') {
  foreach ($marcasModelos as $marca => $modelos) {
    if (in_array($filtroModelo, $modelos)) {
      $filtroMarca = $marca;
      break;
    }
  }
}

// Obtener modelos disponibles según la marca seleccionada
$modelosDisponibles = $filtroMarca && isset($marcasModelos[$filtroMarca])
  ? $marcasModelos[$filtroMarca]
  : array_merge(...array_values($marcasModelos));

$marcasDisponibles = array_keys($marcasModelos);

// Obtener partes desde el controlador
$pt = new SeccionController($seccion);
$partes = $pt->getSecciones();
$cate = $pt->getSeccion();

// Filtrar partes
$partesFiltradas = array_filter($partes, function($parte) use ($filtroMarca, $filtroModelo) {
  return ($filtroMarca === '' || $parte['marca'] === $filtroMarca) &&
         ($filtroModelo === '' || $parte['modelo'] === $filtroModelo);
});

// Ordenar si se seleccionó opción
if ($orden === 'vendidas') {
  usort($partesFiltradas, fn($a, $b) => $b['cantidad_vendida'] - $a['cantidad_vendida']);
} elseif ($orden === 'menos_vendidas') {
  usort($partesFiltradas, fn($a, $b) => $a['cantidad_vendida'] - $b['cantidad_vendida']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Partes de <?= ucfirst($seccion) ?></title>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../estilos/estiloEspecifica.css" />
</head>
<body>
  <div class="main-content" id="mainContent" style="padding-top: 100px;">
    <div class="container">
      <a href="SeccionMarca.php" class="btn btn-primary" style="margin-bottom: 15px;">
        <i class="fas fa-arrow-left"></i> Volver a Secciones
      </a>

      <h1>Partes de <?= htmlspecialchars($cate[0]['categoria'] ?? 'Categoría no encontrada') ?></h1>

      <form method="GET" class="filter-form" id="filterForm">
        <input type="hidden" name="seccion" value="<?= htmlspecialchars($seccion) ?>" />

        <div class="filter-group">
          <label for="marca">Marca</label>
          <select name="marca" id="marca" onchange="filtrarModelos()">
            <option value="">Todas las marcas</option>
            <?php foreach ($marcasDisponibles as $marca): ?>
              <option value="<?= htmlspecialchars($marca) ?>" <?= ($marca === $filtroMarca) ? 'selected' : '' ?>>
                <?= htmlspecialchars($marca) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="filter-group">
          <label for="modelo">Modelo</label>
          <select name="modelo" id="modelo">
            <option value="">Todos los modelos</option>
            <?php foreach ($modelosDisponibles as $modelo): ?>
              <option value="<?= htmlspecialchars($modelo) ?>" <?= ($modelo === $filtroModelo) ? 'selected' : '' ?>>
                <?= htmlspecialchars($modelo) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="filter-group">
          <label for="orden">Ordenar por</label>
          <select name="orden" id="orden">
            <option value="">Seleccionar...</option>
            <option value="vendidas" <?= ($orden === 'vendidas') ? 'selected' : '' ?>>Más vendidas</option>
            <option value="menos_vendidas" <?= ($orden === 'menos_vendidas') ? 'selected' : '' ?>>Menos vendidas</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">
          <i class="fas fa-filter"></i> Filtrar
        </button>
        <button type="button" id="btnLimpiar" class="btn btn-secondary" style="margin-left: 10px;">
          <i class="fas fa-eraser"></i> Limpiar filtros
        </button>
        <button type="submit" name="exportar" value="1" class="btn btn-secondary">
            <i class="fas fa-file-excel"></i> Exportar Inventario
        </button>
        <button type="submit" name="exportar" value="estadisticas" class="btn btn-secondary">
            <i class="fas fa-chart-bar"></i> Exportar Estadísticas
        </button>
      </form>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Miniatura</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Año</th>
              <th>Stock</th>
              <th>Vendidas</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($partesFiltradas) > 0): ?>
              <?php foreach ($partesFiltradas as $parte): ?>
                <tr>
                  <td data-label="Miniatura">
                    <img src="../imagenes/<?= htmlspecialchars($parte['imagen_thumbnail'] ?? '') ?>" class="parte-img" alt="<?= htmlspecialchars($parte['nombre'] ?? '') ?>" />
                  </td>
                  <td data-label="Nombre"><?= htmlspecialchars($parte['nombre'] ?? '') ?></td>
                  <td data-label="Marca"><?= htmlspecialchars($parte['marca'] ?? '') ?></td>
                  <td data-label="Modelo"><?= htmlspecialchars($parte['modelo'] ?? '') ?></td>
                  <td data-label="Año"><?= htmlspecialchars($parte['anio'] ?? '') ?></td>
                  <td data-label="Stock"><?= htmlspecialchars($parte['cantidad_stock'] ?? '0') ?> unidades</td>
                  <td data-label="Vendidas"><?= htmlspecialchars($parte['cantidad_vendida'] ?? '0') ?> vendidas</td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7">
                  <div class="no-results">
                    <i class="fas fa-box-open"></i>
                    <h3>No se encontraron partes</h3>
                    <p>Intenta ajustar tus filtros de búsqueda</p>
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    function filtrarModelos() {
      const marcaSelect = document.getElementById('marca');
      const modeloSelect = document.getElementById('modelo');

      const modelosPorMarca = <?= json_encode($marcasModelos) ?>;
      const marcaSeleccionada = marcaSelect.value;

      // Limpiar modelos
      modeloSelect.innerHTML = '<option value="">Todos los modelos</option>';

      if (marcaSeleccionada && modelosPorMarca[marcaSeleccionada]) {
        modelosPorMarca[marcaSeleccionada].forEach(modelo => {
          const option = document.createElement('option');
          option.value = modelo;
          option.textContent = modelo;
          modeloSelect.appendChild(option);
        });
      }
    }

    document.getElementById("btnLimpiar").addEventListener("click", () => {
      const params = new URLSearchParams();
      params.set('seccion', <?= json_encode($seccion) ?>);
      window.location.href = window.location.pathname + '?' + params.toString();
    });

    window.addEventListener('DOMContentLoaded', () => {
      const marcaSelect = document.getElementById('marca');
      const modeloSelect = document.getElementById('modelo');
      const modeloActual = <?= json_encode($filtroModelo) ?>;

      if (marcaSelect.value) {
        filtrarModelos();

        if (modeloActual) {
          setTimeout(() => {
            modeloSelect.value = modeloActual;
          }, 10);
        }
      }
    });
  </script>
</body>
</html>