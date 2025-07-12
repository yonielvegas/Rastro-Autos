<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Formulario Parte de Auto</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }
  form {
    max-width: 600px; background: #f9f9f9; padding: 20px; border-radius: 8px;
  }
  label { display: block; margin-top: 15px; }
  input, select, textarea {
    width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;
  }
  img.preview {
    max-width: 100px; margin-top: 10px; border-radius: 4px;
  }
  button {
    margin-top: 20px; padding: 10px 20px; background: #007bff;
    border: none; color: white; cursor: pointer; border-radius: 4px;
  }
  button:hover { background: #0056b3; }
</style>
<script>
  function previewImage(input, idPreview) {
    const file = input.files[0];
    const preview = document.getElementById(idPreview);
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  }
</script>
</head>
<body>
  <h2>Crear / Editar Parte de Auto</h2>
  <form action="inventario_save.php" method="POST" enctype="multipart/form-data">
    <label for="nombre_parte">Nombre de la Parte</label>
    <input type="text" id="nombre_parte" name="nombre_parte" required />
    
    <label for="marca">Marca del Auto</label>
    <input type="text" id="marca" name="marca" required />
    
    <label for="modelo">Modelo</label>
    <input type="text" id="modelo" name="modelo" required />
    
    <label for="anio">Año</label>
    <input type="number" id="anio" name="anio" min="1900" max="2100" required />
    
    <label for="seccion">Sección</label>
    <select id="seccion" name="seccion" required>
      <option value="">-- Seleccione --</option>
      <option value="1">Carrocería</option>
      <option value="2">Motor</option>
      <option value="3">Interior</option>
    </select>
    
    <label for="unidades">Unidades</label>
    <input type="number" id="unidades" name="unidades" min="0" required />
    
    <label for="observaciones">Observaciones</label>
    <textarea id="observaciones" name="observaciones" rows="4"></textarea>
    
    <label for="thumbnail">Imagen Thumbnail</label>
    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(this, 'previewThumb')" />
    <img id="previewThumb" class="preview" src="#" alt="Vista previa" style="display:none;" />
    
    <label for="imagen_grande">Imagen Grande</label>
    <input type="file" id="imagen_grande" name="imagen_grande" accept="image/*" onchange="previewImage(this, 'previewGrande')" />
    <img id="previewGrande" class="preview" src="#" alt="Vista previa" style="display:none;" />
    
    <button type="submit">Guardar</button>
  </form>

<script>
  // Mostrar previews sólo si hay imagen cargada
  document.getElementById('thumbnail').addEventListener('change', function() {
    if(this.files.length > 0) {
      document.getElementById('previewThumb').style.display = 'block';
    }
  });
  document.getElementById('imagen_grande').addEventListener('change', function() {
    if(this.files.length > 0) {
      document.getElementById('previewGrande').style.display = 'block';
    }
  });
</script>
</body>
</html>
