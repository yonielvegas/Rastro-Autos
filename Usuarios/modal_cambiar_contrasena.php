<!-- modal_cambiar_contrasena.php -->
<div class="modal-overlay">
  <div class="modal-content">
    <h3>Cambiar Contraseña</h3>
    <form action="../Usuarios/cambiar_contrasena.php" method="POST">
      <label for="passActual">Contraseña Actual</label>
      <input type="password" id="passActual" name="pass_actual" required>

      <label for="passNueva">Nueva Contraseña</label>
      <input type="password" id="passNueva" name="pass_nueva" required>

      <div class="modal-actions">
        <button type="submit" class="btn-confirm" style="background-color: #4361ee;">Guardar</button>
        <button type="button" id="closeModal" class="btn-cancel">Cancelar</button>
      </div>
    </form>
  </div>
</div>
