<?php include '../comunes/navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CRUD Partes de Autos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../estilos/estiloInventario.css" />
  <link rel="stylesheet" href="../estilos/estiloModales.css" />
  <style>
  .search-bar {
    margin: 20px 0;
    display: flex;
    justify-content: flex-start;
  }

  .search-bar input {
    padding: 10px;
    width: 100%;
    max-width: 500px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
  }
</style>

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
            <tr>
              <td class="thumbnail-cell">
                <img src="https://via.placeholder.com/60" alt="Puerta" class="thumbnail" />
              </td>
              <td>PT-2020-001</td>
              <td>Puerta delantera izquierda</td>
              <td>Toyota</td>
              <td>Corolla</td>
              <td>2020</td>
              <td>2023-05-10</td>
              <td>Carrocería</td>
              <td>10</td>
              <td>
                <div class="action-buttons">
                  <button class="btn btn-sm btn-view" onclick="viewPart(1)">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="btn btn-sm btn-edit" onclick="editPart(1)">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-delete" onclick="deletePart(1)">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td class="thumbnail-cell">
                <img src="https://mobilize-fs.es/wp-content/uploads/2023/02/chasis-de-un-coche.jpg" alt="Motor" class="thumbnail" />
              </td>
              <td>MO-2018-002</td>
              <td>Motor 2.0L</td>
              <td>Ford</td>
              <td>Mustang</td> <!-- Cambiado de Focus a Mustang -->
              <td>2018</td>
              <td>2022-11-20</td>
              <td>Motor</td>
              <td>2</td>
              <td>
                <div class="action-buttons">
                  <button class="btn btn-sm btn-view" onclick="viewPart(2)">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="btn btn-sm btn-edit" onclick="editPart(2)">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-delete" onclick="deletePart(2)">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
  include 'modal_EditarAgregarPartes.php';   // Modal agregar/editar parte (debe incluir input entryDate)
  include 'modalVerParte.php';  // Modal solo para ver detalles (modo solo lectura)
?>

<script>
  // Funciones para el modal de partes
  function openModal() {
    document.getElementById('partModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('partModal').style.display = 'none';
    document.getElementById('partForm').reset();
    document.getElementById('imagePreview').innerHTML = '';
  }

  function editPart(id) {
    document.getElementById('modalTitle').textContent = 'Editar Parte';
    document.getElementById('partId').value = id;

    if(id === 1){
      document.getElementById('partName').value = 'Puerta delantera izquierda';
      document.getElementById('partCode').value = 'PT-2020-001';
      document.getElementById('carBrand').value = 'toyota';
      carBrand.dispatchEvent(new Event('change'));
      document.getElementById('carModel').value = 'Corolla';
      document.getElementById('carYear').value = '2020';
      document.getElementById('entryDate').value = '2023-05-10';
      document.getElementById('carCategory').value = 'carroceria';
      document.getElementById('partStock').value = '10';
      document.getElementById('partPrice').value = '150.00';
      document.getElementById('partDescription').value = 'Puerta delantera izquierda para Toyota Corolla 2020, color blanco.';
    }
    if(id === 2){
      document.getElementById('partName').value = 'Motor 2.0L';
      document.getElementById('partCode').value = 'MO-2018-002';
      document.getElementById('carBrand').value = 'ford';
      carBrand.dispatchEvent(new Event('change'));
      document.getElementById('carModel').value = 'Mustang';
      document.getElementById('carYear').value = '2018';
      document.getElementById('entryDate').value = '2022-11-20';
      document.getElementById('carCategory').value = 'motor';
      document.getElementById('partStock').value = '2';
      document.getElementById('partPrice').value = '750.00';
      document.getElementById('partDescription').value = 'Motor 2.0L para Ford Mustang 2018.';
    }

    openModal();
  }

  document.getElementById('addPartBtn').addEventListener('click', () => {
    document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
    document.getElementById('partId').value = '';
    openModal();
  });

  // Funciones para el manejo de imágenes (subida y vista previa)
  document.getElementById('fileInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if(this.files) {
      Array.from(this.files).forEach(file => {
        if(file.type.match('image.*')) {
          const reader = new FileReader();

          reader.onload = function(e) {
            const thumbContainer = document.createElement('div');
            thumbContainer.className = 'thumb-container';

            const img = document.createElement('img');
            img.src = e.target.result;

            const thumbActions = document.createElement('div');
            thumbActions.className = 'thumb-actions';

            thumbContainer.appendChild(img);
            thumbContainer.appendChild(thumbActions);
            preview.appendChild(thumbContainer);
          }

          reader.readAsDataURL(file);
        }
      });
    }
  });

  // Validación y envío del formulario
  document.getElementById('partForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const stock = parseInt(document.getElementById('partStock').value, 10);

    if (isNaN(stock) || stock < 0) {
      alert('El stock debe ser un número válido y no negativo.');
      return;
    }

    // Aquí la lógica para guardar la parte (ajax o submit)
    alert('Parte guardada exitosamente');
    closeModal();
  });

  function deletePart(id) {
    if(confirm('¿Estás seguro de eliminar esta parte?')) {
      // Lógica para eliminar parte
      alert(`Parte ${id} eliminada`);
    }
  }

  // --- Función para ver la parte en modo solo lectura ---
  function viewPart(id) {
    let parte = null;

    if (id === 1) {
      parte = {
        nombre: 'Puerta delantera izquierda',
        codigo: 'PT-2020-001',
        marca: 'Toyota',
        modelo: 'Corolla',
        anio: 2020,
        fecha: '2023-05-10',
        categoria: 'Carrocería',
        stock: 10,
        precio: 150.00,
        descripcion: 'Puerta delantera izquierda para Toyota Corolla 2020, color blanco.',
        imagen: 'https://mobilize-fs.es/wp-content/uploads/2023/02/chasis-de-un-coche.jpg',
        imagen_thumbnail: 'https://via.placeholder.com/60?text=Thumb'
      };
    } else if (id === 2) {
      parte = {
        nombre: 'Motor 2.0L',
        codigo: 'MO-2018-002',
        marca: 'Ford',
        modelo: 'Mustang',
        anio: 2018,
        fecha: '2022-11-20',
        categoria: 'Motor',
        stock: 2,
        precio: 750.00,
        descripcion: 'Motor 2.0L para Ford Mustang 2018.',
        imagen: 'https://mobilize-fs.es/wp-content/uploads/2023/02/chasis-de-un-coche.jpg',
        imagen_thumbnail: 'https://mobilize-fs.es/wp-content/uploads/2023/02/chasis-de-un-coche.jpg'
      };
    } else {
      alert('Parte no encontrada');
      return;
    }

    openViewModal(parte);
  }
  //para busqueda
    document.getElementById('searchInput').addEventListener('input', function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('table tbody tr');

    filas.forEach(fila => {
        const codigo = fila.cells[1].textContent.toLowerCase();
        const nombre = fila.cells[2].textContent.toLowerCase();
        const marca = fila.cells[3].textContent.toLowerCase();
        const modelo = fila.cells[4].textContent.toLowerCase();
        const categoria = fila.cells[7].textContent.toLowerCase();

        const coincide =
        codigo.includes(filtro) ||
        nombre.includes(filtro) ||
        categoria.includes(filtro) ||
        marca.includes(filtro) ||
        modelo.includes(filtro);

        fila.style.display = coincide ? '' : 'none';
    });
    });

</script>

</body>
</html>
