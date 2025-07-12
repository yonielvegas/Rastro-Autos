<!-- modal_partes.php -->
<style>
    /* Estilos específicos del modal de partes */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    
    .modal-content {
        background-color: white;
        border-radius: 10px;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 25px;
        position: relative;
    }
    
    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
        color: var(--gray);
    }
    
    .modal-close:hover {
        color: var(--danger);
    }
    
    .image-upload {
        border: 2px dashed var(--border);
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }
    
    .image-upload:hover {
        border-color: var(--primary);
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .image-upload i {
        font-size: 40px;
        color: var(--gray);
        margin-bottom: 10px;
    }
    
    .image-upload p {
        margin-bottom: 5px;
        color: var(--gray);
    }
    
    .image-upload input[type="file"] {
        display: none;
    }
    
    .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }
    
    .thumb-container {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid var(--border);
    }
    
    .thumb-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .thumb-actions {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        padding: 5px;
    }
    
    .thumb-actions button {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 0 8px;
        font-size: 14px;
    }
    
    .thumb-actions button:hover {
        color: var(--success);
    }

    /* Responsive para el modal */
    @media (max-width: 768px) {
        .modal-content {
            width: 95%;
            padding: 15px;
        }
    }
</style>

<div class="modal" id="partModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Agregar Nueva Parte</h2>
        
        <form id="partForm">
            <input type="hidden" id="partId">
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="partName">Nombre de la Parte</label>
                        <input type="text" id="partName" required placeholder="Ej: Puerta delantera izquierda">
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="partCode">Código</label>
                        <input type="text" id="partCode" required placeholder="Ej: PT-2020-001">
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="carBrand">Marca del Auto</label>
                        <select id="carBrand" required>
                            <option value="">Seleccione una marca</option>
                            <option value="toyota">Toyota</option>
                            <option value="honda">Honda</option>
                            <option value="ford">Ford</option>
                            <option value="chevrolet">Chevrolet</option>
                        </select>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="carModel">Modelo</label>
                        <input type="text" id="carModel" required placeholder="Ej: Corolla">
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="carYear">Año</label>
                        <input type="number" id="carYear" min="1900" max="2023" required placeholder="Ej: 2020">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="partDescription">Descripción</label>
                <textarea id="partDescription" placeholder="Descripción detallada de la parte"></textarea>
            </div>
            
            <div class="form-group">
                <label>Imágenes</label>
                <div class="image-upload" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Arrastra y suelta imágenes aquí o haz clic para seleccionar</p>
                    <small>Formatos aceptados: JPG, PNG (Máx. 5MB)</small>
                    <input type="file" id="fileInput" multiple accept="image/*" style="display: none;">
                </div>
                
                <div class="image-preview" id="imagePreview">
                    <!-- Vista previa de imágenes seleccionadas -->
                </div>
            </div>
            
            <div class="form-group">
                <label for="partStatus">Estado</label>
                <select id="partStatus" required>
                    <option value="available">Disponible</option>
                    <option value="low">Últimas unidades</option>
                    <option value="out">Agotado</option>
                </select>
            </div>
            
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
