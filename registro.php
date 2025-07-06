<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="Estilos/Techmania.css">
    <link rel="stylesheet" href="Estilos/general.css">
</head>
<body>
<div id="wrap">
    <div id="headerlogin"></div>

    <div align="center">
        <h2>Formulario de Registro</h2>
        <div><h2 id="Errores"></h2></div>

        <?php
            session_start();
            if (isset($_SESSION['registro_errores']) && count($_SESSION['registro_errores']) > 0): ?>
                <div>
                    <ul>
                    <?php foreach ($_SESSION['registro_errores'] as $error): ?>
                        <li style="color: red;"><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['registro_errores']); ?>
        <?php endif; ?>

        <form method="post" action="clases/Login/procesarRegistro.php">
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" name="nombre" required /></td>
                </tr>
                <tr>
                    <td>Apellido:</td>
                    <td><input type="text" name="apellido" required /></td>
                </tr>
                <tr>
                    <td>Usuario:</td>
                    <td><input type="text" name="Usuario" required></td>
                </tr>
                <tr>
                    <td>Correo electrónico:</td>
                    <td><input type="email" name="correo" required oninvalid="this.setCustomValidity('El Correo es Obligatorio')" oninput="this.setCustomValidity('')"/></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" name="password" required /></td>
                </tr>
                <tr>
                    <td>Sexo:</td>
                    <td>
                        <select name="sexo" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">Registrarse</button>
                    </td>
                </tr>
            </table>
        </form>


    </div>

    <?php include("footer.php"); ?>
</div>
</body>
</html>

