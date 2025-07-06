<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Ejemplo de Login">
  <meta name="keywords" content="login, ejemplo, autenticación">
  <meta name="author" content="Irina Fong - dreamsweb7@gmail.com">
  <meta name="robots" content="index,follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejemplo de Prueba del Login</title>

  <link rel="shortcut icon" href="patria/5564844.png">
  <link rel="stylesheet" href="estilos/estilo.css">

  <script src="jquery/jquery-latest.js"></script> 
  <script src="jquery/jquery.validate.js"></script>

  <script>
    $(document).ready(function(){
      $("#deteccionUser").validate({
        rules: {
          usuario: "required",
          contrasena: "required"
        }
      });
    });
  </script>
</head>
<body>
  <div id="wrap">
    <div id="headerlogin"></div>

    <div align="center">
      <form class="cmxform" id="deteccionUser" name="deteccionUser" method="post" action="index.php">
        <br>
        <table width="89%" border="0" align="center">
          <tr>
            <td colspan="2" align="center">Desarrollo de Software VII | UTP</td>
          </tr>
          <tr>
            <td width="25%">Usuario:</td>
            <td width="75%"><input id="usuario" name="usuario" type="text" minlength="4" required></td>
          </tr>
          <tr>
            <td>Contraseña:</td>
            <td><input id="contrasena" name="contrasena" type="password" required></td>
          </tr>
          <input type="hidden" name="tolog" id="tolog" value="true">
          <tr>
            <td colspan="2" align="center">
              <input name="Submit" type="submit" class="clear" value="Login">
              <a href="registro.php"><button type="button">Registro</button></a>
            </td>
          </tr>
        </table>
        <br>
      </form>
    </div>
  </div>
  <?php include("footer.php"); ?>
</body>
</html>
