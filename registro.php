<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario | Desarrollo de Software VII</title>
    <link rel="stylesheet" href="estilos/estiloLoginRegistro.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Crear Cuenta</h1>
            <p>Desarrollo de Software VII | UTP</p>
        </div>
        
        <div class="register-form">
            <?php
                session_start();
                if (isset($_SESSION['registro_errores']) && count($_SESSION['registro_errores']) > 0): ?>
                    <div class="error-messages">
                        <ul>
                        <?php foreach ($_SESSION['registro_errores'] as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php unset($_SESSION['registro_errores']); ?>
            <?php endif; ?>
            
            <form method="post" action="clases/Login/procesarRegistro.php">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <i class="fas fa-user-tag input-icon"></i>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>
                </div>
                
                <div class="form-group">
                    <label for="Usuario">Usuario</label>
                    <i class="fas fa-user-circle input-icon"></i>
                    <input type="text" class="form-control" id="Usuario" name="Usuario" placeholder="Crea un nombre de usuario" required>
                </div>
                
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Crea una contraseña segura" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
                <a href="login.php" class="btn btn-secondary">Volver al Login</a>
                
                <div class="form-footer">
                    ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>