<?php 
include '../comunes/navbar.php'; 
require_once '../clases/Conexion.php';
require_once '../clases/ClaseInventario.php';

$conexion = new mod_db();
$inventario = new Inventario($conexion);

$totalRegistros = $inventario->contarPartes();

$opcionesMostrar = [10];
for ($i = 25; $i < $totalRegistros; $i += 25) {
    $opcionesMostrar[] = $i;
}
if (!in_array($totalRegistros, $opcionesMostrar)) {
    $opcionesMostrar[] = $totalRegistros;
}
sort($opcionesMostrar);

$mostrar = isset($_GET['mostrar']) && in_array((int)$_GET['mostrar'], $opcionesMostrar) ? (int)$_GET['mostrar'] : 10;

// Página actual desde GET, por defecto 1
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) && $_GET['pagina'] > 0 ? (int)$_GET['pagina'] : 1;

// Total de páginas
$totalPaginas = max(1, ceil($totalRegistros / $mostrar));

// Limitar página a máximo totalPaginas
if ($pagina > $totalPaginas) $pagina = $totalPaginas;

// Calcular offset
$offset = ($pagina - 1) * $mostrar;

// Obtener partes paginadas (ajusta el método en tu clase Inventario)
$partes = $inventario->obtenerPartesLimitOffset($mostrar, $offset);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CRUD Partes de Autos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloInventario.css" />
  <link rel="stylesheet" href="../estilos/estiloModales.css" />
</head>
<body>
<?php include '../comunes/sidebar.php'; ?>

<div class="main-content" id="mainContent" style="padding-top: 100px;">
  <div class="container">
    <header>
      <h1><i class="fas fa-car"></i> Gestión de Partes de Autos</h1>
      <button class="btn btn-primary" id="addPartBtn">
        <i class="fas fa-plus"></i> Agregar Parte
      </button>
    </header>

    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Buscar por código, nombre, categoría, marca o modelo...">
    </div>

    <!-- Selector para cantidad a mostrar -->
    <div class="show-select">
      <label for="mostrarSelect">Mostrar: </label>
        <select id="mostrarSelect" name="mostrar">
          <?php foreach ($opcionesMostrar as $opcion): ?>
            <option value="<?= $opcion ?>" <?= $mostrar == $opcion ? 'selected' : '' ?>><?= $opcion ?></option>
          <?php endforeach; ?>
        </select>
    </div>

    <div class="card">
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Miniatura</th>
              <th>Código Serie</th>
              <th>Parte</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Año</th>
              <th>Fecha de ingreso</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($partes)): ?>
            <?php foreach ($partes as $parte): ?>
              <tr>
                <td><img src="<?= htmlspecialchars($parte['imagen_thumbnail'] ?? '') ?>" alt="Miniatura" class="thumbnail" /></td>
                <td><?= htmlspecialchars($parte['codigo_serie'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['nombre'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['marca'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['modelo'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['anio'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['fecha_registro'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['categoria'] ?? '') ?></td>
                <td><?= htmlspecialchars($parte['cantidad_stock'] ?? '') ?></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn btn-sm btn-view" onclick="viewPart(<?= $parte['id_parte'] ?>)">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-edit" onclick='editPart(<?= json_encode($parte, JSON_HEX_TAG | JSON_HEX_AMP) ?>)'>
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-delete" onclick="deletePart(<?= $parte['id_parte'] ?>)">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="10" style="text-align:center;">No hay partes registradas.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Barra de paginación -->
    <div class="pagination">
      <?php if ($pagina > 1): ?>
        <a href="?mostrar=<?= $mostrar ?>&pagina=<?= $pagina - 1 ?>">&laquo; Anterior</a>
      <?php endif; ?>

      <?php
      $rango = 3; // Páginas antes y después de la actual
      $inicio = max(1, $pagina - $rango);
      $fin = min($totalPaginas, $pagina + $rango);
      for ($i = $inicio; $i <= $fin; $i++): ?>
        <a href="?mostrar=<?= $mostrar ?>&pagina=<?= $i ?>" class="<?= $pagina == $i ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>

      <?php if ($pagina < $totalPaginas): ?>
        <a href="?mostrar=<?= $mostrar ?>&pagina=<?= $pagina + 1 ?>">Siguiente &raquo;</a>
      <?php endif; ?>
    </div>

  </div>
</div>

<?php
  include 'modal_EditarAgregarPartes.php';
  include 'modalVerParte.php';
?>

<script>
// Al cambiar cantidad mostrar, reinicia a página 1 para evitar página inválida
document.getElementById('mostrarSelect').addEventListener('change', function() {
  const mostrar = this.value;
  window.location.href = '?mostrar=' + mostrar + '&pagina=1';
});

function openModal() {
  document.getElementById('partModal').style.display = 'flex';
}
function closeModal() {
  document.getElementById('partModal').style.display = 'none';
  document.getElementById('partForm').reset();
  document.getElementById('imagePreview').innerHTML = '';
}

function editPart(parte) {
  document.getElementById('modalTitle').textContent = 'Editar Parte';
  document.getElementById('partId').value = parte.id_parte;
  document.getElementById('partName').value = parte.nombre ?? '';
  document.getElementById('partCode').value = parte.codigo_serie ?? '';
  document.getElementById('carBrand').value = (parte.marca ?? '').toLowerCase();
  document.getElementById('carBrand').dispatchEvent(new Event('change'));
  document.getElementById('carModel').value = parte.modelo ?? '';
  document.getElementById('carYear').value = parte.anio ?? '';
  document.getElementById('entryDate').value = parte.fecha_registro ?? '';
  document.getElementById('carCategory').value = (parte.categoria ?? '').toLowerCase();
  document.getElementById('partStock').value = parte.cantidad_stock ?? 0;
  document.getElementById('partPrice').value = parte.precio ?? '';
  document.getElementById('partDescription').value = parte.descripcion ?? '';
  openModal();
}

function viewPart(id) {
  alert('Implementa lógica AJAX para ver la parte con ID: ' + id);
}

function deletePart(id) {
  if (confirm('¿Estás seguro de eliminar esta parte?')) {
    alert(`Parte ${id} eliminada`);
    // Aquí iría la lógica AJAX para eliminar
  }
}

document.getElementById('addPartBtn').addEventListener('click', () => {
  document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
  document.getElementById('partForm').reset();
  document.getElementById('partId').value = '';
  openModal();
});

document.getElementById('fileInput').addEventListener('change', function () {
  const preview = document.getElementById('imagePreview');
  preview.innerHTML = '';
  Array.from(this.files).forEach(file => {
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = e => {
        const div = document.createElement('div');
        div.className = 'thumb-container';
        div.innerHTML = `<img src="${e.target.result}" />`;
        preview.appendChild(div);
      };
      reader.readAsDataURL(file);
    }
  });
});

document.getElementById('partForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const stock = parseInt(document.getElementById('partStock').value);
  if (isNaN(stock) || stock < 0) {
    alert('El stock debe ser un número válido y no negativo.');
    return;
  }
  alert('Parte guardada exitosamente.');
  closeModal();
});

// Filtro búsqueda simple (en la tabla ya cargada)
document.getElementById('searchInput').addEventListener('input', function () {
  const filtro = this.value.toLowerCase();
  document.querySelectorAll('table tbody tr').forEach(fila => {
    const [_, codigo, nombre, marca, modelo, , , categoria] = fila.cells;
    const coincide = [codigo, nombre, marca, modelo, categoria].some(cell =>
      cell.textContent.toLowerCase().includes(filtro)
    );
    fila.style.display = coincide ? '' : 'none';
  });
});
</script>

</body>
</html>
