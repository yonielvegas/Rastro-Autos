<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Partes de Autos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border: #dee2e6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        h1 {
            color: var(--primary);
            font-weight: 600;
            font-size: 28px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-col {
            flex: 1;
            min-width: 0;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s ease;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            font-size: 15px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background-color: var(--gray);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
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
        
        .tab-container {
            margin-bottom: 25px;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            border-bottom-color: var(--primary);
            color: var(--primary);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: var(--primary);
            color: white;
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .thumbnail-cell {
            width: 80px;
        }
        
        .thumbnail {
            width: 60px;
            height: 60px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid var(--border);
        }
        
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .badge-success {
            background-color: #e8f7f0;
            color: #2a9d8f;
        }
        
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-danger {
            background-color: #fce8e8;
            color: #e63946;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 4px;
        }
        
        .btn-edit {
            background-color: var(--success);
            color: white;
        }
        
        .btn-edit:hover {
            opacity: 0.9;
        }
        
        .btn-delete {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-delete:hover {
            opacity: 0.9;
        }
        
        .btn-view {
            background-color: var(--warning);
            color: white;
        }
        
        .btn-view:hover {
            opacity: 0.9;
        }
        
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
        
        .modal-image {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid var(--border);
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .modal-content {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-car"></i> Gestión de Partes de Autos</h1>
            <button class="btn btn-primary" id="addPartBtn">
                <i class="fas fa-plus"></i> Agregar Parte
            </button>
        </header>
        
        <!-- Tab Container -->
        <div class="tab-container">
            <div class="tabs">
                <div class="tab active" data-tab="list">Listado</div>
                <div class="tab" data-tab="images">Galería de Imágenes</div>
            </div>
            
            <!-- List Tab -->
            <div class="tab-content active" id="list-tab">
                <div class="card">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Miniatura</th>
                                    <th>Parte</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="thumbnail-cell">
                                        <img src="https://via.placeholder.com/60" alt="Puerta" class="thumbnail">
                                    </td>
                                    <td>Puerta delantera izquierda</td>
                                    <td>Toyota</td>
                                    <td>Corolla</td>
                                    <td>2020</td>
                                    <td><span class="badge badge-success">Disponible</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-view" onclick="viewImage('https://via.placeholder.com/600')">
                                                <i class="fas fa-image"></i>
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
                                        <img src="https://via.placeholder.com/60" alt="Motor" class="thumbnail">
                                    </td>
                                    <td>Motor 2.0L</td>
                                    <td>Ford</td>
                                    <td>Focus</td>
                                    <td>2018</td>
                                    <td><span class="badge badge-warning">Últimas unidades</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-view" onclick="viewImage('https://via.placeholder.com/600')">
                                                <i class="fas fa-image"></i>
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
                                <tr>
                                    <td class="thumbnail-cell">
                                        <img src="https://via.placeholder.com/60" alt="Retrovisor" class="thumbnail">
                                    </td>
                                    <td>Retrovisor derecho</td>
                                    <td>Honda</td>
                                    <td>Civic</td>
                                    <td>2019</td>
                                    <td><span class="badge badge-danger">Agotado</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-view" onclick="viewImage('https://via.placeholder.com/600')">
                                                <i class="fas fa-image"></i>
                                            </button>
                                            <button class="btn btn-sm btn-edit" onclick="editPart(3)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete" onclick="deletePart(3)">
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
            
            <!-- Images Tab -->
            <div class="tab-content" id="images-tab">
                <div class="card">
                    <div class="image-preview">
                        <!-- Ejemplo de imágenes cargadas -->
                        <div class="thumb-container">
                            <img src="https://via.placeholder.com/120" alt="Parte de auto">
                            <div class="thumb-actions">
                                <button onclick="viewImage('https://via.placeholder.com/800')"><i class="fas fa-search"></i></button>
                                <button onclick="deleteImage(1)"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="thumb-container">
                            <img src="https://via.placeholder.com/120" alt="Parte de auto">
                            <div class="thumb-actions">
                                <button onclick="viewImage('https://via.placeholder.com/800')"><i class="fas fa-search"></i></button>
                                <button onclick="deleteImage(2)"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <!-- Más imágenes... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para agregar/editar partes -->
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
    
    <!-- Modal para ver imagen grande -->
    <div class="modal" id="imageModal">
        <div class="modal-content" style="max-width: 90%;">
            <span class="modal-close" onclick="closeImageModal()">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="Imagen ampliada">
            <div style="text-align: center;">
                <button class="btn btn-secondary" onclick="closeImageModal()">Cerrar</button>
            </div>
        </div>
    </div>
    
    <script>
        // Funciones para manejar las pestañas
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelector('.tab.active').classList.remove('active');
                tab.classList.add('active');
                
                document.querySelector('.tab-content.active').classList.remove('active');
                document.getElementById(`${tab.dataset.tab}-tab`).classList.add('active');
            });
        });
        
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
            
            // Aquí iría la lógica para cargar los datos de la parte
            // Ejemplo con datos de prueba:
            document.getElementById('partName').value = 'Puerta delantera izquierda';
            document.getElementById('partCode').value = 'PT-2020-001';
            document.getElementById('carBrand').value = 'toyota';
            document.getElementById('carModel').value = 'Corolla';
            document.getElementById('carYear').value = '2020';
            document.getElementById('partDescription').value = 'Puerta delantera izquierda para Toyota Corolla 2020, color blanco.';
            document.getElementById('partStatus').value = 'available';
            
            openModal();
        }
        
        document.getElementById('addPartBtn').addEventListener('click', () => {
            document.getElementById('modalTitle').textContent = 'Agregar Nueva Parte';
            document.getElementById('partId').value = '';
            openModal();
        });
        
        // Funciones para el manejo de imágenes
        function viewImage(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').style.display = 'flex';
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
        
        function deleteImage(id) {
            if(confirm('¿Estás seguro de eliminar esta imagen?')) {
                // Aquí iría la lógica para eliminar la imagen
                alert(`Imagen ${id} eliminada`);
            }
        }
        
        // Manejo de la subida de imágenes
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
        
        // Manejo del formulario
        document.getElementById('partForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Aquí iría la lógica para guardar la parte
            alert('Parte guardada exitosamente');
            closeModal();
        });
        
        function deletePart(id) {
            if(confirm('¿Estás seguro de eliminar esta parte?')) {
                // Aquí iría la lógica para eliminar la parte
                alert(`Parte ${id} eliminada`);
            }
        }
    </script>
</body>
</html>