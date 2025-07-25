<div class="part-modal" id="viewPartModal">
    <div class="part-modal__backdrop" onclick="closeViewModal()"></div>
    <div class="part-modal__container">
        <div class="part-modal__header">
            <h2 class="part-modal__title" id="viewModalTitle">Detalles de la Parte</h2>
            <button class="part-modal__close-btn" onclick="closeViewModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="part-modal__body">
            <div class="part-info-grid">
                <div class="part-info-item">
                    <label>Nombre de la Parte</label>
                    <p id="viewPartName" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Código de Serie</label>
                    <p id="viewPartCode" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Marca del Auto</label>
                    <p id="viewCarBrand" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Modelo</label>
                    <p id="viewCarModel" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Año</label>
                    <p id="viewCarYear" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Categoría</label>
                    <p id="viewCarCategory" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Precio</label>
                    <p id="viewPartPrice" class="part-info-value">-</p>
                </div>
                <div class="part-info-item">
                    <label>Stock</label>
                    <p id="viewPartStock" class="part-info-value">-</p>
                </div>
            </div>

            <div class="part-info-full">
                <label>Fecha de Ingreso</label>
                <p id="viewEntryDate" class="part-info-value">-</p>
            </div>

            <div class="part-description">
                <label>Descripción</label>
                <p id="viewPartDescription" class="part-info-value">-</p>
            </div>

            <div class="part-images">
                <div class="part-image-thumbnail" id="viewThumbnailContainer">
                    <label>Miniatura</label>
                    <div class="image-wrapper">
                        <img id="viewThumbnail" alt="Miniatura">
                    </div>
                </div>
                <div class="part-image-main" id="viewImageContainer">
                    <label>Imagen Principal</label>
                    <div class="image-wrapper">
                        <img id="viewImage" alt="Imagen de la parte">
                    </div>
                </div>
            </div>
        </div>

        <div class="part-modal__footer">
            <button class="btn btn-close" onclick="closeViewModal()">Cerrar</button>
        </div>
    </div>
</div>
<script>
    function openViewModal(parte) {
        // Llenar información básica
        document.getElementById('viewPartName').textContent = parte.nombre || '-';
        document.getElementById('viewPartCode').textContent = parte.codigo_serie || '-';
        document.getElementById('viewCarBrand').textContent = parte.marca || '-';
        document.getElementById('viewCarModel').textContent = parte.modelo || '-';
        document.getElementById('viewCarYear').textContent = parte.anio || '-';
        document.getElementById('viewCarCategory').textContent = parte.categoria || '-';
        document.getElementById('viewPartPrice').textContent = parte.precio != null ? `$${parseFloat(parte.precio).toFixed(2)}` : '-';
        document.getElementById('viewPartStock').textContent = parte.cantidad_stock != null ? parte.cantidad_stock : '-';
        document.getElementById('viewEntryDate').textContent = parte.fecha_registro || '-';
        document.getElementById('viewPartDescription').textContent = parte.descripcion || '-';

        // Manejar imágenes
        const thumbImg = document.getElementById('viewThumbnail');
        const mainImg = document.getElementById('viewImage');
        
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

        // Mostrar modal
        document.getElementById('viewPartModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeViewModal() {
        document.getElementById('viewPartModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        // Opcional: limpiar los campos al cerrar para asegurar que no se vean datos viejos brevemente
        document.getElementById('viewPartName').textContent = '-';
        document.getElementById('viewPartCode').textContent = '-';
        document.getElementById('viewCarBrand').textContent = '-';
        document.getElementById('viewCarModel').textContent = '-';
        document.getElementById('viewCarYear').textContent = '-';
        document.getElementById('viewCarCategory').textContent = '-';
        document.getElementById('viewPartPrice').textContent = '-';
        document.getElementById('viewPartStock').textContent = '-';
        document.getElementById('viewEntryDate').textContent = '-';
        document.getElementById('viewPartDescription').textContent = '-';
        document.getElementById('viewThumbnail').src = '';
        document.getElementById('viewImage').src = '';
        document.getElementById('viewThumbnail').style.display = 'none';
        document.getElementById('viewImage').style.display = 'none';
    }
</script>