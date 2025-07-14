<div class="modal" id="modalUserForm" style="display:none;">
    <div class="modal-content">
        <button class="close-btn" id="closeModalBtn" aria-label="Cerrar modal">&times;</button>
        <h2>Crear / Editar Usuario</h2>

        <?php
        // PHP: Muestra los errores de validación si la variable $errores contiene mensajes.
        // Después de mostrar, limpia la variable de sesión para evitar que se muestren de nuevo.
        if (!empty($errores)):
        ?>
            <div id="modalErrorsContainer" class="alert-error" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                <strong>Errores:</strong>
                <ul id="modalErrorList" style="margin: 0; padding-left: 20px;">
                    <?php foreach ($errores as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errores']); ?>
        <?php endif; ?>

        <form action="usuario_save.php" method="POST" id="formUsuario">
            <input type="hidden" id="id_usuario" name="id_usuario" value="<?= htmlspecialchars($form_data['id'] ?? '') ?>">

            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej: Juan Pérez"  value="<?= htmlspecialchars($form_data['nombre'] ?? '') ?>"/>
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required placeholder="Ej: juanperez123" pattern="^\S{4,}$" title="Debe tener al menos 4 caracteres y sin espacios"
                value="<?= htmlspecialchars($form_data['usuario'] ?? '') ?>"/>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required placeholder="Ej: 61234567" pattern="^\d{8}$" title="Debe contener exactamente 8 dígitos numéricos"
                value="<?= htmlspecialchars($form_data['telefono'] ?? '') ?>" />
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required placeholder="Ej: usuario@dominio.com" value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" />
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" />
                <div class="password-strength">
                    <div class="strength-bar" id="strength-bar"></div> </div>
            </div>

            <div class="form-group">
                <label for="password2">Confirmar Contraseña</label>
                <input type="password" id="password2" name="password2" placeholder="Repite la contraseña" />
            </div>

            <div class="form-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="">-- Seleccione un rol --</option>
                    <option value="1" <?= (isset($form_data['rol']) && $form_data['rol'] == 1) ? 'selected' : '' ?>>Administrador</option>
                    <option value="2" <?= (isset($form_data['rol']) && $form_data['rol'] == 2) ? 'selected' : '' ?>>Usuario</option>
                </select>
            </div>

            <div class="form-group">
                <label for="activo">Estado</label>
                <select id="activo" name="activo" required>
                    <option value="1" <?= (isset($form_data['activo']) && $form_data['activo'] == 1) ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= (isset($form_data['activo']) && $form_data['activo'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>

            <button type="submit">Guardar Usuario</button>
        </form>
    </div>
</div>

<style>
    /*
     * CSS para el modal:
     * Define la apariencia, el posicionamiento, el centrado y las animaciones de entrada del modal.
     * Incluye estilos para los campos del formulario, botones y la barra de fuerza de la contraseña,
     * asegurando un diseño responsivo y consistente.
     */
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
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        border: 1px solid #f5c6cb;
        animation: fadeOut 0.5s ease-out 4.5s forwards;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            visibility: hidden;
            height: 0;
            margin: 0;
            padding: 0;
        }
    }
</style>

<script>
    // --- Funciones para manejar el modal y la lógica de sesión ---

    // **limpiarSesionModal()**: Envía una solicitud AJAX para limpiar variables de sesión en el servidor.
    function limpiarSesionModal() {
        fetch('limpiar_sesion_modal.php', { // Asegúrate de que esta ruta sea correcta
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data.message); // Útil para depuración
        })
        .catch(error => {
            console.error('Error al limpiar sesión:', error);
        });
    }

    // Referencias a elementos del DOM del modal.
    const modal = document.getElementById('modalUserForm');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modalErrorsContainer = document.getElementById('modalErrorsContainer');
    const modalErrorList = document.getElementById('modalErrorList'); // UL dentro del contenedor de errores

    // Event Listeners para cerrar el modal al hacer clic en el botón 'X' o fuera del modal.
    // También limpia la sesión y el contenido del modal al cerrar.
    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        limpiarSesionModal();
        limpiarContenidoModal(true); // Ocultar y limpiar errores.
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            limpiarSesionModal();
            limpiarContenidoModal(true); // Ocultar y limpiar errores.
        }
    });

    // **limpiarContenidoModal()**: Limpia visualmente los campos del formulario y los mensajes de error del modal.
    // El parámetro `shouldClearErrorsAndHideContainer` controla si los errores deben ocultarse y limpiarse.
    function limpiarContenidoModal(shouldClearErrorsAndHideContainer = true) {
        // Vaciar los campos del formulario.
        document.getElementById('id_usuario').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('usuario').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
        document.getElementById('password2').value = '';
        document.getElementById('rol').value = '';
        document.getElementById('activo').value = '1';

        if (shouldClearErrorsAndHideContainer) {
            // Si es true, oculta el contenedor de errores y limpia la lista de errores.
            if (modalErrorsContainer) {
                modalErrorsContainer.style.display = 'none';
                modalErrorList.innerHTML = '';
            }
        } else {
            // Si es false, asegura que el contenedor de errores esté visible (útil para errores PHP pre-cargados).
            if (modalErrorsContainer) {
                modalErrorsContainer.style.display = 'block';
            }
        }

        // Restablecer el título del modal.
        modal.querySelector('h2').textContent = 'Crear / Editar Usuario';

        // Restablecer la barra de fuerza de contraseña.
        const strengthBar = document.getElementById('strength-bar');
        if (strengthBar) {
            strengthBar.style.width = '0%';
            strengthBar.style.backgroundColor = '#e63946'; // Color inicial.
        }
    }

    // **abrirModalUsuario()**: Abre el modal. Si se proporciona un objeto `usuario`, rellena el formulario para edición; de lo contrario, lo prepara para crear un nuevo usuario.
    // Utiliza la variable PHP `fue_redireccion_por_error` para determinar si debe mostrar errores pre-existentes.
    function abrirModalUsuario(usuario = null) {
        limpiarSesionModal(); // Limpia la sesión del servidor.

        // `fue_redireccion_por_error` es una variable PHP que debe ser inyectada en este script.
        const isRedirectionByError = <?php echo json_encode($fue_redireccion_por_error ?? false); ?>;

        // Limpia el contenido del modal (campos y/o errores) según si hubo una redirección por error.
        limpiarContenidoModal(!isRedirectionByError);

        modal.style.display = 'block'; // Muestra el modal.
        document.body.style.overflow = 'hidden'; // Evita el scroll del fondo.

        const titulo = modal.querySelector('h2');
        const idInput = document.getElementById('id_usuario');
        const nombre = document.getElementById('nombre');
        const usuarioInput = document.getElementById('usuario');
        const telefonoInput = document.getElementById('telefono');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const password2 = document.getElementById('password2');
        const rol = document.getElementById('rol');
        const activo = document.getElementById('activo');

        // Rellena los campos del formulario si es edición, o establece el título para "Crear Usuario".
        if (usuario) {
            titulo.textContent = 'Editar Usuario';
            idInput.value = usuario.id ?? '';
            nombre.value = usuario.nombre ?? '';
            usuarioInput.value = usuario.usuario ?? '';
            telefonoInput.value = usuario.telefono ?? '';
            email.value = usuario.email ?? '';
            password.value = ''; // Contraseñas en blanco por seguridad.
            password2.value = ''; // Contraseñas en blanco por seguridad.
            rol.value = usuario.rol ?? '';
            activo.value = usuario.activo != null ? String(usuario.activo) : '1';
        } else {
            titulo.textContent = 'Crear Usuario';
        }
    }

    // --- Lógica de la barra de fuerza de contraseña ---
    // Actualiza dinámicamente la barra de fuerza (`strength-bar`) y su color basándose en la complejidad de la contraseña.
    const password = document.getElementById('password');
    const strengthBar = document.getElementById('strength-bar');

    password.addEventListener('input', function () {
        const val = password.value;
        let strength = 0; // Nivel de fuerza.

        if (val.length > 0) strength += 1;
        if (val.length >= 8) strength += 1;
        if (/[A-Z]/.test(val)) strength += 1; // Mayúsculas.
        if (/[0-9]/.test(val)) strength += 1; // Números.
        if (/[^A-Za-z0-9]/.test(val)) strength += 1; // Caracteres especiales.

        const percent = (strength / 5) * 100;
        strengthBar.style.width = percent + '%';

        if (strength <= 2) {
            strengthBar.style.backgroundColor = '#e63946'; // Rojo (débil)
        } else if (strength <= 4) {
            strengthBar.style.backgroundColor = '#f4a261'; // Naranja (media)
        } else {
            strengthBar.style.backgroundColor = '#2a9d8f'; // Verde (fuerte)
        }
    });

    // Script para ocultar automáticamente los mensajes de error después de 5 segundos.
    document.addEventListener('DOMContentLoaded', function () {
        const errorBox = document.getElementById('modalErrorsContainer');
        if (errorBox) {
            setTimeout(() => {
                errorBox.style.display = 'none';
            }, 5000); // Oculta el contenedor a los 5 segundos
        }
    });
</script>