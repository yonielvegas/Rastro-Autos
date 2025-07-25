<?php
include '../comunes/navbar.php';
require_once '../clases/conexion.php';
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

$todosLosModelos = $inventario->obtenerTodosLosModelos();
$modelosPorMarcaId = [];
foreach ($todosLosModelos as $mod) {
    if (!isset($modelosPorMarcaId[$mod['id_marca']])) {
        $modelosPorMarcaId[$mod['id_marca']] = [];
    }
    $modelosPorMarcaId[$mod['id_marca']][] = [
        'id_modelo' => $mod['id_modelo'],
        'modelo_nombre' => $mod['modelo']
    ];
}

// También necesitarás un mapeo de marcas (nombre a ID) para el frontend,
// similar a como ya tienes categoryIdMap
$todasLasMarcas = $inventario->obtenerTodasLasMarcas(); // Necesitarías crear este método en ClaseInventario.php
$marcaNameToIdMap = [];
foreach ($todasLasMarcas as $marca) {
    $marcaNameToIdMap[strtolower($marca['marca'])] = $marca['id_marca'];
}

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
      <?php if (isset($_SESSION['permisos']) && in_array(2, $_SESSION['permisos'])): ?>
          <button class="btn btn-primary" id="addPartBtn">
              <i class="fas fa-plus"></i> Agregar Parte
          </button>
      <?php endif; ?>
    </header>

    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Buscar por código, nombre, categoría, marca o modelo...">
    </div>

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
                    <button class="btn btn-sm btn-edit" onclick='editarParte(<?= json_encode($parte, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
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
  const allModelsData = <?= json_encode($modelosPorMarcaId, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
  const marcaNameToIdMap = <?= json_encode($marcaNameToIdMap, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

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

function editarParte(parte) {
   openModal();
    document.getElementById('modalTitle').textContent = 'Editar Parte';

    document.getElementById('partId').value = parte.id_parte;
    document.getElementById('partName').value = parte.nombre ?? '';
    document.getElementById('partCode').value = parte.codigo_serie ?? '';

    const marcaSeleccionadaEditar = (parte.marca ?? '').toLowerCase();
    document.getElementById('carBrand').value = marcaSeleccionadaEditar;
    document.getElementById('carBrand').dispatchEvent(new Event('change')); // Dispara para cargar modelos

    // Pequeño retardo para asegurar que los modelos se cargaron antes de seleccionar
    setTimeout(() => {
        document.getElementById('carModel').value = parte.id_modelo ?? ''; // <-- Ahora usa id_modelo
    }, 50);

    document.getElementById('carYear').value = parte.anio ?? ''; // Asegúrate de cargar el año aquí
    document.getElementById('entryDate').value = parte.fecha_registro ?? '';
    document.getElementById('carCategory').value = (parte.categoria ?? '').toLowerCase();
    document.getElementById('partStock').value = parte.cantidad_stock ?? 0;
    document.getElementById('partPrice').value = parte.precio ?? '';
    document.getElementById('partDescription').value = parte.descripcion ?? '';
  openModal();
}

function viewPart(id) {
    const viewModal = document.getElementById('viewPartModal');
    if (!viewModal) {
        alert('Error: No se encontró el modal de visualización (viewPartModal).');
        return;
    }

    // Limpiar el contenido previo del modal
    document.getElementById('viewModalTitle').textContent = 'Cargando Detalles...';
    document.getElementById('viewPartName').textContent = 'Cargando...';
    document.getElementById('viewPartCode').textContent = '';
    document.getElementById('viewCarBrand').textContent = '';
    document.getElementById('viewCarModel').textContent = '';
    document.getElementById('viewCarYear').textContent = '';
    document.getElementById('viewEntryDate').textContent = '';
    document.getElementById('viewCarCategory').textContent = '';
    document.getElementById('viewPartStock').textContent = '';
    document.getElementById('viewPartPrice').textContent = '';
    document.getElementById('viewPartDescription').textContent = '';
    document.getElementById('viewThumbnail').src = '';
    document.getElementById('viewImage').src = '';
    document.getElementById('viewThumbnail').style.display = 'none';
    document.getElementById('viewImage').style.display = 'none';

    // Mostrar el modal mientras se cargan los datos
    viewModal.style.display = 'flex';

    const formData = new FormData();
    formData.append('action', 'ver');
    formData.append('id_parte', id);

    fetch('../clases/procesar_inventario.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        // CORRECCIÓN: Usar data.data en lugar de data.parte
        if (data.success && data.data) {
            const parte = data.data; // <--- ¡AQUÍ ESTÁ LA CORRECCIÓN!
            document.getElementById('viewModalTitle').textContent = 'Detalles de ' + (parte.nombre ?? 'Parte');
            document.getElementById('viewPartName').textContent = parte.nombre ?? 'N/A';
            document.getElementById('viewPartCode').textContent = parte.codigo_serie ?? 'N/A';
            document.getElementById('viewCarBrand').textContent = parte.marca ?? 'N/A';
            document.getElementById('viewCarModel').textContent = parte.modelo ?? 'N/A';
            document.getElementById('viewCarYear').textContent = parte.anio ?? 'N/A';
            document.getElementById('viewEntryDate').textContent = parte.fecha_registro ?? 'N/A';
            document.getElementById('viewCarCategory').textContent = parte.categoria ?? 'N/A';
            document.getElementById('viewPartStock').textContent = parte.cantidad_stock ?? '0';
            document.getElementById('viewPartPrice').textContent = `$${(parseFloat(parte.precio ?? 0)).toFixed(2)}`;
            document.getElementById('viewPartDescription').textContent = parte.descripcion ?? 'Sin descripción.';

            const thumbImg = document.getElementById('viewThumbnail');
            const mainImg = document.getElementById('viewImage');

            // Manejo de imágenes (sin el prefijo "../" porque la carpeta "uploads" está dentro de "inventario")
            if (parte.imagen_thumbnail) {
                thumbImg.src = parte.imagen_thumbnail;
                thumbImg.style.display = 'block';
            } else {
                thumbImg.src = '';
                thumbImg.style.display = 'none';
            }

            if (parte.imagen) {
                mainImg.src = parte.imagen;
                mainImg.style.display = 'block';
            } else {
                mainImg.src = '';
                mainImg.style.display = 'none';
            }

        } else {
            // Este bloque maneja los casos en los que el servidor dice que hubo un error
            alert('Error al cargar la parte: ' + (data.message || 'No se encontraron datos.'));
            viewModal.style.display = 'none';
        }
    })
    .catch(error => {
        // Este bloque se ejecuta para errores de red
        console.error('Error en la solicitud de visualización:', error);
        alert('Hubo un problema al intentar ver la parte. Consulta la consola para más detalles.');
        viewModal.style.display = 'none';
    });
}

document.getElementById('addPartBtn').addEventListener('click', () => {
  document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
  document.getElementById('partForm').reset();
  document.getElementById('partId').value = '';
  openModal();
});

document.getElementById('partImage').addEventListener('change', function () {
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

document.getElementById('addPartBtn').addEventListener('click', () => {
  document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
  document.getElementById('partForm').reset();
  document.getElementById('partId').value = '';
  openModal();
});

document.getElementById('partForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const stock = parseInt(document.getElementById('partStock').value);
    if (isNaN(stock) || stock < 0) {
        alert('El stock debe ser un número válido y no negativo.');
        return;
    }

    const formData = new FormData(this);
    const partId = document.getElementById('partId').value; // Obtener el ID de la parte

    // Determinar la acción (agregar o actualizar)
    if (partId) {
        formData.append('action', 'actualizar'); // Si hay un ID, es una actualización
        formData.append('id_parte', partId);    // Asegúrate de enviar el ID
    } else {
        formData.append('action', 'agregar'); // Si no hay ID, es una nueva adición
    }

    // Añadir manualmente los valores de los select mapeados a IDs
    const brandName = document.getElementById('carBrand').value;
    const modelId = document.getElementById('carModel').value;
    const categoryName = document.getElementById('carCategory').value;

    const categoryIdMap = { 'carroceria': 1, 'motor': 2, 'puertas': 3, 'vidrios': 4, 'espejos': 5 };

    formData.append('nombre', document.getElementById('partName').value);
    formData.append('codigo_serie', document.getElementById('partCode').value);
    formData.append('id_marca', marcaNameToIdMap[brandName] || 0);
    formData.append('id_modelo', modelId);
    formData.append('anio', document.getElementById('carYear').value); // Asegúrate de que 'anio' se envíe
    formData.append('fecha_registro', document.getElementById('entryDate').value);
    formData.append('id_cat', categoryIdMap[categoryName] || 0);
    formData.append('cantidad_stock', document.getElementById('partStock').value);
    formData.append('precio', document.getElementById('partPrice').value);
    formData.append('descripcion', document.getElementById('partDescription').value);

    const fileInput = document.getElementById('partImage');
    if (fileInput && fileInput.files && fileInput.files[0]) {
        formData.append('imagen', fileInput.files[0]);
    } else {
        // Si no se selecciona una nueva imagen, pero es una actualización,
        // no es necesario hacer nada aquí, PHP se encargará de mantener la existente.
        console.log("No se seleccionó una nueva imagen para subir.");
    }

    fetch('../clases/procesar_inventario.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeModal();
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema al guardar la parte.');
    });
});


function deletePart(id) {
    if (confirm('¿Estás seguro de eliminar esta parte? Esta acción es irreversible.')) {
        const formData = new FormData();
        formData.append('action', 'eliminar'); // Indicar la acción
        formData.append('id_parte', id);     // Enviar el ID de la parte a eliminar

        fetch('../clases/procesar_inventario.php', { // Asegúrate que la ruta sea correcta
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) { // Si la respuesta no es 2xx, lanzar un error
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Recargar la página para ver el cambio
            } else {
                alert('Error al eliminar: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud de eliminación:', error);
            alert('Hubo un problema al intentar eliminar la parte. Consulta la consola para más detalles.');
        });
    }
}

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