<?php
// usuario.php o donde esté tu modal, antes de salida HTML

require_once '../clases/conexion.php';
$db = new mod_db();
$roles = $db->query("SELECT * FROM roles WHERE id_rol IN (1, 2)");
?>

<!-- Modal -->
<div class="modal" id="modalUserForm" style="display:none;">
  <div class="modal-content">
    <button class="close-btn" id="closeModalBtn" aria-label="Cerrar modal">&times;</button>
    <h2>Crear / Editar Usuario</h2>
    <form action="usuario_save.php" method="POST" id="formUsuario">
      <input type="hidden" id="id_usuario" name="id_usuario" value="">

      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required placeholder="Ej: Juan" />
      </div>

      <div class="form-group">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" required placeholder="Ej: Pérez" />
      </div>

      <div class="form-group">
        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" required placeholder="Ej: usuario@dominio.com" />
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" required placeholder="Ej: +507 6000-0000" />
      </div>

      <div class="form-group">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" required placeholder="Nombre de usuario" />
      </div>

      <div class="form-group" id="rolGroup">
        <label for="rol">Rol</label>
        <select id="rol" name="rol" required>
          <option value="">-- Seleccione un rol --</option>
          <?php foreach ($roles as $r): ?>
            <option value="<?= htmlspecialchars($r['id_rol']) ?>"><?= htmlspecialchars($r['nombre_rol']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" />
        <div class="password-strength">
          <div class="strength-bar" id="strength-bar"></div>
        </div>
      </div>

      <div class="form-group">
        <label for="password2">Confirmar Contraseña</label>
        <input type="password" id="password2" name="password2" placeholder="Repite la contraseña" />
      </div>

      <button type="submit">Guardar Usuario</button>
    </form>
  </div>
</div>
<style>
  /* El mismo estilo que ya tenías */
  .modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.5);
    overflow-y: auto;
    padding: 40px 20px;
  }
  .modal-content {
    background: #ffffff;
    max-width: 480px;
    margin: 0 auto;
    border-radius: 12px;
    padding: 30px 25px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
    position: relative;
    animation: slideDown 0.3s ease forwards;
  }
  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    font-size: 22px;
    font-weight: 700;
    color: #555;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  .close-btn:hover {
    color: #4e6ef2;
  }
  h2 {
    text-align: center;
    color: #4e6ef2;
    margin-bottom: 25px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
  }
  .form-group {
    margin-bottom: 18px;
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #555;
    font-family: 'Inter', sans-serif;
  }
  input,
  select {
    width: 100%;
    padding: 12px;
    font-size: 15px;
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    background: #fff;
    transition: border 0.2s ease;
    font-family: 'Inter', sans-serif;
  }
  input:focus,
  select:focus {
    border-color: #4e6ef2;
    outline: none;
    box-shadow: 0 0 0 3px rgba(78, 110, 242, 0.15);
  }
  .password-strength {
    height: 6px;
    background-color: #e0e0e0;
    border-radius: 3px;
    margin-top: 6px;
    overflow: hidden;
  }
  .strength-bar {
    height: 100%;
    width: 0%;
    background-color: #e63946;
    transition: width 0.3s ease;
  }
  button[type="submit"] {
    width: 100%;
    padding: 14px;
    background: #4e6ef2;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-family: 'Inter', sans-serif;
  }
  button[type="submit"]:hover {
    background-color: #3b55c9;
  }
  @media (max-width: 600px) {
    .modal-content {
      padding: 20px;
    }
  }
</style>

<script>
  const modal = document.getElementById('modalUserForm');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const rolSelect = document.getElementById('rol');
  const rolGroup = document.getElementById('rolGroup');
  const passwordInput = document.getElementById('password');
  const strengthBar = document.getElementById('strength-bar');

  closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
  });

  // Password strength bar
  passwordInput.addEventListener('input', function () {
    const val = this.value;
    let strength = 0;

    if (val.length > 0) strength += 1;
    if (val.length >= 8) strength += 1;
    if (/[A-Z]/.test(val)) strength += 1;
    if (/[0-9]/.test(val)) strength += 1;
    if (/[^A-Za-z0-9]/.test(val)) strength += 1;

    const percent = (strength / 5) * 100;
    strengthBar.style.width = percent + '%';

    if (strength <= 2) {
      strengthBar.style.backgroundColor = '#e63946'; // Rojo
    } else if (strength <= 4) {
      strengthBar.style.backgroundColor = '#f4a261'; // Naranja
    } else {
      strengthBar.style.backgroundColor = '#2a9d8f'; // Verde
    }
  });

  function abrirModalUsuario(usuario = null) {
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';

    const titulo = modal.querySelector('h2');
    const idInput = document.getElementById('id_usuario');
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const correo = document.getElementById('correo');
    const telefono = document.getElementById('telefono');
    const usuarioInput = document.getElementById('usuario');
    const password = document.getElementById('password');
    const password2 = document.getElementById('password2');

    if (usuario) {
      titulo.textContent = 'Editar Usuario';
      idInput.value = usuario.id_usuario || '';
      nombre.value = usuario.nombre || '';
      apellido.value = usuario.apellido || '';
      correo.value = usuario.correo || '';
      telefono.value = usuario.telefono || '';
      usuarioInput.value = usuario.usuario || '';
      rolGroup.style.display = 'none'; // Ocultar select rol al editar
      password.value = '';
      password2.value = '';
      strengthBar.style.width = '0%';
      strengthBar.style.backgroundColor = '#e0e0e0';
    } else {
      titulo.textContent = 'Crear Usuario';
      idInput.value = '';
      nombre.value = '';
      apellido.value = '';
      correo.value = '';
      telefono.value = '';
      usuarioInput.value = '';
      rolGroup.style.display = 'block'; // Mostrar select rol al crear
      rolSelect.value = ''; // Reset valor
      password.value = '';
      password2.value = '';
      strengthBar.style.width = '0%';
      strengthBar.style.backgroundColor = '#e0e0e0';
    }
  }
</script>