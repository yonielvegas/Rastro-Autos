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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- Esto para Ajustar el tamaño del input de telefono con la libreria TellInput -->
    <style>
        .iti {
            width: 100% !important;
        }
        .iti input {
            width: 100% !important;
            padding-left: 50px !important;
        }

        .error-messages {
            color: red;
            margin-top: 5px;
            font-weight: 600;
        }
        .error-messages ul {
            padding-left: 20px;
        }
        .error-messages li {
            margin-bottom: 4px;
        }

    </style>


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
            
            <form method="post" action="clases/Registro/procesarRegistro.php">
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
                    <label for="telefono">Telefono</label>
                    <i class="fas fa-phone input-icon"></i>
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="(+507) Ingresa tu numero de telefono" require>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Crea una contraseña segura" required>
                </div>

                <div class="form-group">
                    <label for="password">Confirmar Contraseña</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Escribe la misma contraseña" required>
                </div>
                
                <input type="hidden" id="id_rol" name="id_rol" value="3">

                <?php
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
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
                <a href="login.php" class="btn btn-secondary">Volver al Login</a>
                
                <div class="form-footer">
                    ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const input = document.querySelector("#telefono");
        window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: callback => {
            fetch('https://ipinfo.io/json')
                .then(resp => resp.json())
                .then(resp => callback(resp.country))
                .catch(() => callback("us"));
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
    </script>


</body>
</html>