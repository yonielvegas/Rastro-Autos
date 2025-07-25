<div class="part-edit-modal" id="partModal">
  <div class="part-edit-modal__backdrop" onclick="closeModal()"></div>
  <div class="part-edit-modal__container">
    <div class="part-edit-modal__header">
      <h2 class="part-edit-modal__title" id="modalTitle">Agregar Nueva Parte</h2>
      <button class="part-edit-modal__close-btn" onclick="closeModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <form class="part-edit-modal__form" enctype="multipart/form-data" id="partForm">
      <input type="hidden" id="partId">

      <div class="form-grid">
        <div class="form-group">
          <label for="partName">Nombre de la Parte</label>
          <input type="text" id="partName" required placeholder="Ej: Puerta delantera izquierda">
        </div>
        <div class="form-group">
          <label for="partCode">Código de serie</label>
          <input type="text" id="partCode" required placeholder="Ej: PT-2020-001">
        </div>

        <div class="form-group">
          <label for="carBrand">Marca del Auto</label>
          <select id="carBrand" required>
            <option value="">Seleccione una marca</option>
            <option value="toyota">Toyota</option>
            <option value="mazda">Mazda</option>
            <option value="ford">Ford</option>
          </select>
        </div>
        <div class="form-group">
          <label for="carModel">Modelo</label>
          <select id="carModel" required disabled>
            <option value="">Seleccione un modelo</option>
          </select>
        </div>
        <div class="form-group">
          <label for="carYear">Año</label>
          <input type="number" id="carYear" min="1900" max="2025" required placeholder="Ej: 2020">
        </div>

        <div class="form-group">
          <label for="carCategory">Categoría</label>
          <select id="carCategory" required>
            <option value="">Seleccione una categoría</option>
            <option value="carroceria">Carrocería</option>
            <option value="motor">Motor</option>
            <option value="puertas">Puertas</option>
            <option value="espejos">Espejos</option>
            <option value="vidrios">Vidrios</option>
          </select>
        </div>
        <div class="form-group">
          <label for="partPrice">Precio ($)</label>
          <input type="number" id="partPrice" step="0.01" min="0" required placeholder="Ej: 150.00">
        </div>
        <div class="form-group">
          <label for="partStock">Stock</label>
          <input type="number" id="partStock" min="0" required placeholder="Ej: 10">
        </div>

        <div class="form-group full-width">
          <label for="entryDate">Fecha de Ingreso</label>
          <input type="date" id="entryDate" required>
        </div>

        <div class="form-group full-width">
          <label for="partDescription">Descripción</label>
          <textarea id="partDescription" rows="4" placeholder="Descripción detallada de la parte" required></textarea>
        </div>

        <div class="form-group full-width">
          <label>Imágenes</label>
          <div class="image-upload-area" onclick="document.getElementById('partImage').click()">
            <div class="upload-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
              </svg>
            </div>
            <p class="upload-text">Arrastra y suelta imágenes aquí o haz clic para seleccionar</p>
            <p class="upload-hint">Formatos aceptados: JPG, JPEG, PNG (Máx. 5MB)</p>
            <input type="file" id="partImage" multiple accept="image/*" style="display: none;">
          </div>
          <div class="image-preview-grid" id="imagePreview"></div>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancelar</button>
        <button type="submit" class="btn btn-save">Guardar</button>
      </div>
    </form>
  </div>
</div>

<script>

  const carBrand = document.getElementById('carBrand');
  const carModel = document.getElementById('carModel');

  carBrand.addEventListener('change', () => {
      const marcaSeleccionadaNombre = carBrand.value; // 'toyota', 'mazda', etc.
      carModel.innerHTML = '<option value="">Seleccione un modelo</option>';
      carModel.disabled = true; // Deshabilitar por defecto

      // Obtener el ID de la marca seleccionada
      const idMarcaSeleccionada = marcaNameToIdMap[marcaSeleccionadaNombre] || null;

      if (idMarcaSeleccionada && allModelsData[idMarcaSeleccionada]) {
          allModelsData[idMarcaSeleccionada].forEach(modeloData => { // Itera sobre los datos del modelo
              const option = document.createElement('option');
              option.value = modeloData.id_modelo; // <-- ¡Aquí es el ID!
              option.textContent = modeloData.modelo_nombre;
              carModel.appendChild(option);
          });
          carModel.disabled = false;
      }
  });


  document.getElementById('partImage').addEventListener('change', function (e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (this.files) {
      Array.from(this.files).forEach(file => {
        if (file.type.match('image.*')) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const previewItem = document.createElement('div');
            previewItem.className = 'image-preview-item';

            const img = document.createElement('img');
            img.src = e.target.result;

            const actions = document.createElement('div');
            actions.className = 'image-preview-actions';

            previewItem.appendChild(img);
            previewItem.appendChild(actions);
            preview.appendChild(previewItem);
          }
          reader.readAsDataURL(file);
        }
      });
    }
  });

  function closeModal() {
    document.getElementById('partModal').style.display = 'none';
    document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
    document.getElementById('partForm').reset();
    document.getElementById('imagePreview').innerHTML = '';
    carModel.innerHTML = '<option value="">Seleccione un modelo</option>';
    carModel.disabled = true;
  }

  function openModal() {
    document.getElementById('partModal').style.display = 'flex';
  }

  function openAddModal() {
    openModal();
    document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
    document.getElementById('partForm').reset();
    document.getElementById('imagePreview').innerHTML = '';
    carModel.innerHTML = '<option value="">Seleccione un modelo</option>';
    carModel.disabled = true;

    const today = new Date().toISOString().split('T')[0];
    document.getElementById('entryDate').value = today;
  }

  function editarParte(parte) {
    openModal();
    document.getElementById('modalTitle').textContent = 'Editar Parte';

    document.getElementById('partId').value = parte.id_parte; // Asegúrate de usar id_parte
    document.getElementById('partName').value = parte.nombre ?? '';
    document.getElementById('partCode').value = parte.codigo_serie ?? '';
    document.getElementById('carBrand').value = parte.marca;

    const marcaSeleccionadaEditar = (parte.marca ?? '').toLowerCase();
    document.getElementById('carBrand').value = marcaSeleccionadaEditar;
    document.getElementById('carBrand').dispatchEvent(new Event('change')); // Dispara para cargar modelos

    setTimeout(() => { // Pequeño retardo para asegurar que los modelos se cargaron
      document.getElementById('carModel').value = parte.id_modelo ?? ''; // <-- ¡Correcto, usa el ID!
    }, 50);

    document.getElementById('carYear').value = parte.anio ?? '';
    document.getElementById('entryDate').value = parte.fecha_registro ?? '';
    document.getElementById('carCategory').value = (parte.categoria ?? '').toLowerCase();
    document.getElementById('partStock').value = parte.cantidad_stock ?? 0;
    document.getElementById('partPrice').value = parte.precio ?? '';
    document.getElementById('partDescription').value = parte.descripcion ?? '';

    // Cargar imágenes previas
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    if (parte.imagenes && Array.isArray(parte.imagenes)) {
      parte.imagenes.forEach(url => {
        const previewItem = document.createElement('div');
        previewItem.className = 'image-preview-item';

        const img = document.createElement('img');
        img.src = url;

        const actions = document.createElement('div');
        actions.className = 'image-preview-actions';

        previewItem.appendChild(img);
        previewItem.appendChild(actions);
        preview.appendChild(previewItem);
      });
    }
  }

  // Cambia aquí para que el botón agregue con fecha hoy:
  document.getElementById('addPartBtn').addEventListener('click', openAddModal);
</script>