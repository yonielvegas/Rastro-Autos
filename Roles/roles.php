<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Roles y Permisos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }

    .form-container {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      margin-top: 0;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #444;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #4e6ef2;
      color: white;
    }

    .button {
      background-color: #4e6ef2;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
    }

    .button:hover {
      background-color: #3b55c9;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Asignar Rol a Usuario</h2>
    <form action="guardar_rol.php" method="post">

      <label for="usuario">Nombre del Usuario</label>
      <input type="text" id="usuario" name="usuario" required>

      <label for="rol">Rol</label>
      <select id="rol" name="rol" required>
        <option value="">Seleccionar rol</option>
        <option value="Administrador">Administrador</option>
        <option value="Inventario">Inventario</option>
        <option value="Ventas">Ventas</option>
        <option value="Compras">Compras</option>
        <!-- Puedes agregar más roles -->
      </select>

      <label>Módulos y Permisos</label>
      <table>
        <thead>
          <tr>
            <th>Módulo</th>
            <th>Lectura</th>
            <th>Escritura</th>
            <th>Control total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Usuarios</td>
            <td><input type="checkbox" name="permisos[usuarios][]" value="leer"></td>
            <td><input type="checkbox" name="permisos[usuarios][]" value="escribir"></td>
            <td><input type="checkbox" name="permisos[usuarios][]" value="total"></td>
          </tr>
          <tr>
            <td>Inventario</td>
            <td><input type="checkbox" name="permisos[inventario][]" value="leer"></td>
            <td><input type="checkbox" name="permisos[inventario][]" value="escribir"></td>
            <td><input type="checkbox" name="permisos[inventario][]" value="total"></td>
          </tr>
          <tr>
            <td>Ventas</td>
            <td><input type="checkbox" name="permisos[ventas][]" value="leer"></td>
            <td><input type="checkbox" name="permisos[ventas][]" value="escribir"></td>
            <td><input type="checkbox" name="permisos[ventas][]" value="total"></td>
          </tr>
          <tr>
            <td>Compras</td>
            <td><input type="checkbox" name="permisos[compras][]" value="leer"></td>
            <td><input type="checkbox" name="permisos[compras][]" value="escribir"></td>
            <td><input type="checkbox" name="permisos[compras][]" value="total"></td>
          </tr>
        </tbody>
      </table>

      <button type="submit" class="button">Guardar Permisos</button>
    </form>
  </div>

</body>
</html>
