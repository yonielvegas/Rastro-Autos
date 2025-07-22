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
          <option value="Operador">Operador</option>
        </select>
      </div>

      <div id="permisos-container">
        <label>Permisos Generales</label>
        <div class="checkbox-group">
          <label><input type="checkbox" name="permisos[]" value="leer" /> Lectura</label>
          <label><input type="checkbox" name="permisos[]" value="escribir" /> Escritura</label>
          <label><input type="checkbox" name="permisos[]" value="reporte" /> Generar Reportes</label>
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

    const usuariosExistentes = [
      { nombre: 'Juan Pérez', rol: 'Administrador', permisos: [] },
      { nombre: 'María García', rol: 'Operador', permisos: ['leer', 'reporte'] },
      { nombre: 'Carlos López', rol: 'Operador', permisos: ['leer', 'escribir'] },
      { nombre: 'Ana Martínez', rol: 'Administrador', permisos: [] },
      { nombre: 'Sofía González', rol: 'Operador', permisos: ['leer'] }
    ];

    function actualizarPermisosSegunRol(rol) {
      if (rol === 'Operador') {
        permisosContainer.style.display = 'block';
      } else {
        permisosContainer.style.display = 'none';
        checkboxes.forEach(c => c.checked = false);
      }
    }

    rolSelect.addEventListener('change', () => {
      actualizarPermisosSegunRol(rolSelect.value);
    });

    window.addEventListener('DOMContentLoaded', () => {
      actualizarPermisosSegunRol(rolSelect.value);
    });

    usuarioInput.addEventListener('input', () => {
      const val = usuarioInput.value.toLowerCase();
      autocompleteList.innerHTML = '';
      if (!val) return;

      const filtrados = usuariosExistentes.filter(u => u.nombre.toLowerCase().includes(val));

      if (filtrados.length === 0) {
        const item = document.createElement('div');
        item.classList.add('autocomplete-item');
        item.textContent = 'No se encontraron coincidencias';
        autocompleteList.appendChild(item);
        return;
      }

      filtrados.forEach(u => {
        const item = document.createElement('div');
        item.classList.add('autocomplete-item');

        const nombreSpan = document.createElement('span');
        const index = u.nombre.toLowerCase().indexOf(val);
        nombreSpan.innerHTML = u.nombre.substring(0, index) +
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

          if (u.rol === 'Operador') {
            permisosContainer.style.display = 'block';
            checkboxes.forEach(cb => {
              cb.checked = u.permisos.includes(cb.value);
            });
          } else {
            permisosContainer.style.display = 'none';
            checkboxes.forEach(cb => cb.checked = false);
          }
        });

        autocompleteList.appendChild(item);
      });
    });

    document.addEventListener('click', (e) => {
      if (e.target !== usuarioInput) {
        autocompleteList.innerHTML = '';
      }
    });
  </script>
</body>
</html>
