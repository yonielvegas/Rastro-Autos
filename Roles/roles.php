<?php 
include '../comunes/sidebar.php'; 
include '../comunes/navbar.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Asignar Rol y Permisos</title>
  <link rel="stylesheet" href="../estilos/estiloRoles.css" />
  <style>
    .autocomplete-item {
      padding: 5px;
      border: 1px solid #ccc;
      cursor: pointer;
    }
    .autocomplete-item:hover {
      background-color: #f0f0f0;
    }
    .role-badge {
      float: right;
      font-size: 0.8em;
      background: #ddd;
      padding: 2px 6px;
      border-radius: 4px;
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Asignar Rol y Permisos</h2>
    <form action="guardar_rol.php" method="post" autocomplete="off">
      <div class="form-group" style="position: relative;">
        <label for="usuario">Nombre de Usuario</label>
        <div class="input-wrapper">
          <input type="text" id="usuario" name="usuario" placeholder="Buscar usuario..." required autocomplete="off" />
          <div id="autocomplete-list" class="autocomplete-items"></div>
        </div>
      </div>

      <div class="form-group">
        <label for="rol">Rol</label>
        <select id="rol" name="rol" required>
          <option value="">Seleccione un rol</option>
          <option value="Administrador">Administrador</option>
          <option value="operativo">Operador</option>
        </select>
      </div>

      <div id="permisos-container" style="display: none;">
        <label>Permisos Generales</label>
        <div class="checkbox-group">
          <label><input type="checkbox" name="permisos[]" value="lectura" /> Lectura</label>
          <label><input type="checkbox" name="permisos[]" value="escritura" /> Escritura</label>
          <label><input type="checkbox" name="permisos[]" value="generar_reporte" /> Generar Reportes</label>
        </div>
      </div>

      <button type="submit" class="btn">Guardar Configuración</button>
    </form>
  </div>

  <script>
    const rolSelect = document.getElementById('rol');
    const permisosContainer = document.getElementById('permisos-container');
    const usuarioInput = document.getElementById('usuario');
    const autocompleteList = document.getElementById('autocomplete-list');
    const checkboxes = permisosContainer.querySelectorAll('input[type="checkbox"]');

    function actualizarPermisosSegunRol(rol) {
      if (rol === 'Operador') {
        permisosContainer.style.display = 'block';
      } else {
        permisosContainer.style.display = 'none';
        checkboxes.forEach(c => {
          c.checked = false;
          c.disabled = false;
        });
      }
    }

    usuarioInput.addEventListener('input', () => {
      const val = usuarioInput.value.toLowerCase().trim();
      autocompleteList.innerHTML = '';
      if (!val) return;

      fetch(`buscar_usuarios.php?term=${encodeURIComponent(val)}`)
        .then(response => response.json())
        .then(data => {
          console.log('Resultado de búsqueda:', data);
          autocompleteList.innerHTML = '';
          if (data.length === 0) {
            const item = document.createElement('div');
            item.classList.add('autocomplete-item');
            item.textContent = 'No se encontraron coincidencias';
            autocompleteList.appendChild(item);
            return;
          }

          data.forEach(u => {
            const item = document.createElement('div');
            item.classList.add('autocomplete-item');

            const nombreSpan = document.createElement('span');
            const index = u.nombre.toLowerCase().indexOf(val);
            nombreSpan.innerHTML =
              u.nombre.substring(0, index) +
              '<strong>' + u.nombre.substring(index, index + val.length) + '</strong>' +
              u.nombre.substring(index + val.length);

            const roleBadge = document.createElement('span');
            roleBadge.className = 'role-badge';
            roleBadge.textContent = u.rol;

            item.appendChild(nombreSpan);
            item.appendChild(roleBadge);

            item.addEventListener('click', () => {
              usuarioInput.value = u.nombre;
              autocompleteList.innerHTML = '';
              rolSelect.value = u.rol;
              rolSelect.dispatchEvent(new Event('change'));

              if (u.rol === 'operativo') {
                permisosContainer.style.display = 'block';
                const permisosUsuario = u.permisos ? u.permisos.split(',').map(p => p.trim()) : [];
                checkboxes.forEach(cb => {
                  cb.checked = permisosUsuario.includes(cb.value);
                });
              } else {
                permisosContainer.style.display = 'none';
                checkboxes.forEach(cb => cb.checked = false);
              }
            });

            autocompleteList.appendChild(item);
          });
        })
        .catch(err => console.error('Error al buscar usuarios:', err));
    });

    rolSelect.addEventListener('change', () => {
      actualizarPermisosSegunRol(rolSelect.value);
    });

    window.addEventListener('DOMContentLoaded', () => {
      actualizarPermisosSegunRol(rolSelect.value);
    });

    document.addEventListener('click', (e) => {
      if (!autocompleteList.contains(e.target) && e.target !== usuarioInput) {
        autocompleteList.innerHTML = '';
      }
    });

    checkboxes.forEach(cb => {
      cb.addEventListener('change', () => {
        const escrituraChecked = Array.from(checkboxes).some(c => c.value === 'escritura' && c.checked);
        const reporteChecked = Array.from(checkboxes).some(c => c.value === 'generar_reporte' && c.checked);
        const lecturaCheckbox = Array.from(checkboxes).find(c => c.value === 'lectura');

        if (escrituraChecked || reporteChecked) {
          lecturaCheckbox.checked = true;
          lecturaCheckbox.disabled = true;
        } else {
          lecturaCheckbox.disabled = false;
        }
      });
    });
  </script>
</body>
</html>
