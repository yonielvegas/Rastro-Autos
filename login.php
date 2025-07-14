<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso Premium | Desarrollo de Software VII</title>
  <link rel="stylesheet" href="estilos/estiloLoginRegistro.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <h1>Bienvenido</h1>
      <p>Desarrollo de Software VII | UTP</p>
    </div>
    
    <form class="login-form" id="deteccionUser" name="deteccionUser" method="post" action="index.php">
      <div class="form-group">
        <label for="usuario">Usuario</label>
        <i class="fas fa-user input-icon"></i>
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
      </div>
      
      <div class="form-group">
        <label for="contrasena">Contraseña</label>
        <i class="fas fa-lock input-icon"></i>
        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
      </div>
      
      <input type="hidden" name="tolog" id="tolog" value="true">
      
      <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
      <a href="registro.php" class="btn btn-secondary">Crear Cuenta</a>
      
    </form>
  </div>

  <script src="jquery/jquery-latest.js"></script> 
  <script src="jquery/jquery.validate.js"></script>
  
  <script>
    $(document).ready(function(){
      $("#deteccionUser").validate({
        rules: {
          usuario: {
            required: true,
            minlength: 4
          },
          contrasena: {
            required: true,
            minlength: 6
          }
        },
        messages: {
          usuario: {
            required: "Este campo es obligatorio",
            minlength: "Mínimo 4 caracteres"
          },
          contrasena: {
            required: "Este campo es obligatorio",
            minlength: "Mínimo 6 caracteres"
          }
        },
        errorElement: "span",
        errorClass: "error",
        highlight: function(element) {
          $(element).addClass('error');
        },
        unhighlight: function(element) {
          $(element).removeClass('error');
        }
      });
    });
  </script>
</body>
</html>