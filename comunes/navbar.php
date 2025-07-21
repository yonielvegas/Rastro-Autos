<!-- Font Awesome para el ícono -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<nav class="navbar">
  <div class="user-info">
    <div class="welcome-message" id="welcomeMessage">Hola, Invitado</div>
    <img src="" alt="Foto de Usuario" class="user-photo" id="userPhoto" />
    
    <a href="cambiar_contrasena.php" class="change-pass-btn" title="Cambiar contraseña">
      <i class="fas fa-key"></i>
    </a>

    <a href="logout.php" class="logout-btn" title="Cerrar sesión">
      <i class="fas fa-power-off"></i>
    </a>
  </div>
</nav>

<style>
  .navbar {
    height: 70px;
    background-color: #212529;
    color: white;
    padding: 0 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    box-sizing: border-box;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .welcome-message {
    font-weight: 600;
    white-space: nowrap;
  }

  .user-photo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
  }

  .logout-btn,
  .change-pass-btn {
    background: transparent;
    border: none;
    color: #e63946; /* rojo por defecto */
    font-size: 20px;
    padding: 6px;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: color 0.3s ease;
  }

  .change-pass-btn {
    color: #fbbc04; /* color dorado para el ícono de cambiar contraseña */
  }

  .change-pass-btn:hover {
    color: #ffcd38; /* dorado más claro al pasar el mouse */
  }

  .logout-btn:hover {
    color: #ff4e5b;
  }
</style>

<script>
  const usuario = {
    nombre: 'Juan Pérez',
    foto: 'https://randomuser.me/api/portraits/men/75.jpg'
  };

  document.getElementById('welcomeMessage').textContent = `Hola, ${usuario.nombre}`;
  document.getElementById('userPhoto').src = usuario.foto;
  document.getElementById('userPhoto').alt = `Foto de ${usuario.nombre}`;
</script>
