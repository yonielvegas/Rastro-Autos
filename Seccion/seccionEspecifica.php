<?php
include '../comunes/navbar.php';
include '../comunes/sidebar.php';

// Limpieza de parámetros GET
$seccion = isset($_GET['seccion']) ? htmlspecialchars($_GET['seccion']) : '';
$filtroMarca = isset($_GET['marca']) ? htmlspecialchars($_GET['marca']) : '';
$filtroModelo = isset($_GET['modelo']) ? htmlspecialchars($_GET['modelo']) : '';
$orden = isset($_GET['orden']) ? htmlspecialchars($_GET['orden']) : '';

// Marcas y modelos agrupados
$marcasModelos = [
  'Toyota' => ['Corolla', 'Rav4', 'Prado'],
  'Mazda' => ['CX-5', 'MX-5 Miata', 'CX-30'],
  'Ford'  => ['Mustang', 'Escape', 'F-150']
];

// Si sólo eligió modelo pero no marca, determinar la marca automáticamente
if ($filtroMarca === '' && $filtroModelo !== '') {
  foreach ($marcasModelos as $marca => $modelos) {
    if (in_array($filtroModelo, $modelos)) {
      $filtroMarca = $marca;
      break;
    }
  }
}

// Construimos arrays planos para dropdowns según la marca seleccionada o no
if ($filtroMarca !== '' && isset($marcasModelos[$filtroMarca])) {
  $modelosDisponibles = $marcasModelos[$filtroMarca];
} else {
  // Si no hay marca seleccionada, mostramos todos los modelos
  $modelosDisponibles = [];
  foreach ($marcasModelos as $modList) {
    $modelosDisponibles = array_merge($modelosDisponibles, $modList);
  }
}

// Marcas disponibles (todo el arreglo de keys)
$marcasDisponibles = array_keys($marcasModelos);

// Simulación de partes
$partes = [
  ['miniatura' => 'motor.png', 'nombre' => 'Motor V8', 'marca' => 'Toyota', 'modelo' => 'Corolla', 'anio' => 2020, 'stock' => 10, 'vendidas' => 5],
  ['miniatura' => 'puerta.png', 'nombre' => 'Puerta Delantera', 'marca' => 'Mazda', 'modelo' => 'CX-5', 'anio' => 2021, 'stock' => 3, 'vendidas' => 12],
  ['miniatura' => 'espejo.png', 'nombre' => 'Espejo Retrovisor', 'marca' => 'Ford', 'modelo' => 'Mustang', 'anio' => 2019, 'stock' => 8, 'vendidas' => 9],
];

// Filtrar partes
$partesFiltradas = array_filter($partes, function($parte) use ($filtroMarca, $filtroModelo) {
  return ($filtroMarca === '' || $parte['marca'] === $filtroMarca) &&
         ($filtroModelo === '' || $parte['modelo'] === $filtroModelo);
});

if ($orden === 'vendidas') {
  usort($partesFiltradas, fn($a, $b) => $b['vendidas'] - $a['vendidas']);
}
elseif ($orden === 'menos_vendidas') {
  usort($partesFiltradas, fn($a, $b) => $a['vendidas'] - $b['vendidas']);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Partes de <?= ucfirst($seccion) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloEspecifica.css" />
</head>
<body>
  <div class="main-content" id="mainContent" style="padding-top: 100px;">
    <div class="container">
    <a href="SeccionMarca.php" class="btn btn-primary" style="margin-bottom: 15px;">
        <i class="fas fa-arrow-left"></i> Volver a Secciones
    </a>

      <h1>Partes de <?= ucfirst($seccion) ?></h1>

      <form method="GET" class="filter-form" id="filterForm">
        <input type="hidden" name="seccion" value="<?= htmlspecialchars($seccion) ?>" />

        <div class="filter-group">
          <label for="marca">Marca</label>
          <select name="marca" id="marca" onchange="filtrarModelos()">
            <option value="">Todas las marcas</option>
            <?php foreach ($marcasDisponibles as $marca): ?>
              <option value="<?= htmlspecialchars($marca) ?>" <?= ($marca == $filtroMarca) ? 'selected' : '' ?>>
                <?= $marca ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="filter-group">
          <label for="modelo">Modelo</label>
          <select name="modelo" id="modelo">
            <option value="">Todos los modelos</option>
            <?php foreach ($modelosDisponibles as $modelo): ?>
              <option value="<?= htmlspecialchars($modelo) ?>" <?= ($modelo == $filtroModelo) ? 'selected' : '' ?>>
                <?= $modelo ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="filter-group">
          <label for="orden">Ordenar por</label>
        <select name="orden" id="orden">
        <option value="">Seleccionar...</option>
        <option value="vendidas" <?= ($orden == 'vendidas') ? 'selected' : '' ?>>Más vendidas</option>
        <option value="menos_vendidas" <?= ($orden == 'menos_vendidas') ? 'selected' : '' ?>>Menos vendidas</option> <!-- NUEVO -->
        </select>

        </div>

        <button type="submit" class="btn btn-primary">
          <i class="fas fa-filter"></i> Filtrar
        </button>
        <button type="submit" name="exportar" value="1" class="btn btn-secondary">
          <i class="fas fa-file-excel"></i> Exportar
        </button>
        <button type="button" id="btnLimpiar" class="btn btn-secondary" style="margin-left: 10px;">
          <i class="fas fa-eraser"></i> Limpiar filtros
        </button>
      </form>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>miniatura</th>
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
                    <img src="../imagenes/<?= htmlspecialchars($parte['miniatura']) ?>" alt="<?= htmlspecialchars($parte['nombre']) ?>" class="parte-img" />
                  </td>
                  <td data-label="Nombre"><?= htmlspecialchars($parte['nombre']) ?></td>
                  <td data-label="Marca"><?= htmlspecialchars($parte['marca']) ?></td>
                  <td data-label="Modelo"><?= htmlspecialchars($parte['modelo']) ?></td>
                  <td data-label="Año"><?= htmlspecialchars($parte['anio']) ?></td>
                  <td data-label="Stock"><?= $parte['stock'] ?> unidades</span></td>
                  <td data-label="Vendidas"><?= $parte['vendidas'] ?> vendidas</span></td>
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
const marcasModelos = <?= json_encode($marcasModelos) ?>;

function filtrarModelos() {
  const marcaSelect = document.getElementById('marca');
  const modeloSelect = document.getElementById('modelo');
  const marcaSeleccionada = marcaSelect.value;

  // Guardamos modelo actual para mantenerlo
  const modeloPrevio = modeloSelect.value;

  // Limpiar opciones actuales excepto la primera
  modeloSelect.options.length = 1;

  if (marcaSeleccionada && marcasModelos[marcaSeleccionada]) {
    // Añadir solo modelos de la marca seleccionada
    marcasModelos[marcaSeleccionada].forEach(modelo => {
      const option = document.createElement('option');
      option.value = modelo;
      option.text = modelo;
      modeloSelect.appendChild(option);
    });
  } else {
    // Mostrar todos los modelos
    Object.values(marcasModelos).flat().forEach(modelo => {
      const option = document.createElement('option');
      option.value = modelo;
      option.text = modelo;
      modeloSelect.appendChild(option);
    });
  }

  // Restaurar selección si sigue disponible
  for (let i = 0; i < modeloSelect.options.length; i++) {
    if (modeloSelect.options[i].value === modeloPrevio) {
      modeloSelect.selectedIndex = i;
      break;
    }
  }
}

// Cuando cambie modelo, actualizar marca automáticamente
function actualizarMarcaSegunModelo() {
  const marcaSelect = document.getElementById('marca');
  const modeloSelect = document.getElementById('modelo');
  const modeloSeleccionado = modeloSelect.value;

  if (!modeloSeleccionado) {
    // Si no hay modelo seleccionado, no cambiar marca
    return;
  }

  // Buscar marca del modelo seleccionado
  let marcaEncontrada = '';
  for (const [marca, modelos] of Object.entries(marcasModelos)) {
    if (modelos.includes(modeloSeleccionado)) {
      marcaEncontrada = marca;
      break;
    }
  }

  if (marcaEncontrada && marcaSelect.value !== marcaEncontrada) {
    marcaSelect.value = marcaEncontrada;
    // Actualizamos modelos porque marca cambió
    filtrarModelos();
  }
}

// Eventos
document.addEventListener('DOMContentLoaded', () => {
  filtrarModelos();

  // Al cambiar marca, actualizar modelos
  document.getElementById('marca').addEventListener('change', filtrarModelos);

  // Al cambiar modelo, actualizar marca
  document.getElementById('modelo').addEventListener('change', actualizarMarcaSegunModelo);

  // Botón limpiar filtros
  document.getElementById('btnLimpiar').addEventListener('click', () => {
    const form = document.getElementById('filterForm');
    form.querySelector('#marca').value = '';
    form.querySelector('#modelo').value = '';
    form.querySelector('#orden').value = '';
    form.submit();
  });
});
</script>
</body>
</html>
