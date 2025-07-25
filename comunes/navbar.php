<?php
require_once '../clases/logger.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
logger::info("Contenido de la sesión en Navbar:\n" . print_r($_SESSION, true));

// Verificar si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== "SI") {
    header("Location: ../comunes/login.php");
    exit();
}

?>

<!-- Font Awesome para el ícono -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<nav id="navbar-user-session" class="navbar">
    <div class="user-info">
    <div class="welcome-message" id="welcomeMessage">Hola, Invitado</div>
    <img src="" alt="Foto de Usuario" class="user-photo" id="userPhoto" />
    
    <a href="#" class="change-pass-btn" title="Cambiar contraseña" id="openChangePass">
      <i class="fas fa-key"></i>
    </a>

    <a href="../comunes/logout.php" class="logout-btn" title="Cerrar sesión">
      <i class="fas fa-power-off"></i>
    </a>
  </div>
</nav>

<style>
#navbar-user-session.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  height: 70px;
  background-color: #212529;
  color: white;
  padding: 0 20px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  box-sizing: border-box;
  z-index: 90;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

#navbar-user-session .user-info {
  display: flex;
  align-items: center;
  gap: 14px;
}

#navbar-user-session .welcome-message {
  font-weight: 600;
  white-space: nowrap;
}

#navbar-user-session .user-photo {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  line-height: 25.6;
  border: 2px solid white;
}

#navbar-user-session .logout-btn,
#navbar-user-session .change-pass-btn {
  background: transparent;
  border: none;
  color: #e63946;
  font-size: 20px;
  padding: 6px;
  cursor: pointer;
  text-decoration: none;
  display: flex;
  align-items: center;
  transition: color 0.3s ease;
}

#navbar-user-session .change-pass-btn {
  color: #fbbc04;
}

#navbar-user-session .change-pass-btn:hover {
  color: #ffcd38;
}

#navbar-user-session .logout-btn:hover {
  color: #ff4e5b;
}

  /* Estilos para el modal que cargaremos dinámicamente */
#modal-cambiar-pass .modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

#modal-cambiar-pass .modal-content {
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

#modal-cambiar-pass .modal-content h3 {
  margin-top: 0;
  margin-bottom: 15px;
  text-align: center;
}

#modal-cambiar-pass .modal-content label {
  display: block;
  margin-top: 10px;
}

#modal-cambiar-pass .modal-content input {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

#modal-cambiar-pass .modal-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

#modal-cambiar-pass .btn-confirm {
  background-color: #28a745;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#modal-cambiar-pass .btn-cancel {
  background-color: #dc3545;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


    body main,
    body .content {
      padding-top: 70px;
    }

</style>

<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

  if (!isset($_SESSION['usuario'])) {
    header('Location: ../comunes/login.php');
    exit;
  }
?>
<script>
  const usuario = {
    nombre: "<?= $_SESSION['usuario'] ?>",
    foto: '../imagenes/foto_perfil.jpg'
  };

  document.getElementById('welcomeMessage').textContent = `Hola, ${usuario.nombre}`;
  document.getElementById('userPhoto').src = usuario.foto;
  document.getElementById('userPhoto').alt = `Foto de ${usuario.nombre}`;

  // ---- Modal Dinámico via AJAX ----
  const openBtn = document.getElementById('openChangePass');
  let modalContainer = null;

  openBtn.addEventListener('click', async function(e) {
    e.preventDefault();

    // Si el modal no existe en DOM, lo cargamos
    if (!modalContainer) {
      modalContainer = document.createElement('div');
      modalContainer.id = 'modal-cambiar-pass';
      document.body.appendChild(modalContainer);

      try {
        const response = await fetch('../Usuarios/modal_cambiar_contrasena.php');
        if (!response.ok) throw new Error('Error cargando el modal');
        const html = await response.text();
        modalContainer.innerHTML = html;

        // Mostrar el modal
        const overlay = modalContainer.querySelector('.modal-overlay');
        overlay.style.display = 'flex';

        // Agregar evento para cerrar modal
        const closeBtn = modalContainer.querySelector('#closeModal');
        closeBtn.addEventListener('click', () => {
          overlay.style.display = 'none';
        });

        // Cerrar modal si se hace click fuera del contenido
        overlay.addEventListener('click', (event) => {
          if (event.target === overlay) {
            overlay.style.display = 'none';
          }
        });

      } catch (error) {
        alert('No se pudo cargar el formulario para cambiar contraseña.');
        console.error(error);
      }

    } else {
      // Ya está cargado, solo mostrarlo
      const overlay = modalContainer.querySelector('.modal-overlay');
      overlay.style.display = 'flex';
    }
  });
</script>
