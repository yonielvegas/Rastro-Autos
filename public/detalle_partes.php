<!-- detalle_parte.php -->
<?php
$id_parte = $_GET['id'] ?? 1; // ID ficticio

// Datos simulados (en producción, consultar BD)
$partes = [
  1 => [
    'nombre' => 'Motor',
    'auto' => 'Honda Civic 2015',
    'imagen' => 'img/motor.jpg',
    'costo' => '350.00',
    'unidades' => 2,
    'observaciones' => 'Motor probado y garantizado, sin fugas.'
  ],
  2 => [
    'nombre' => 'Puerta Derecha',
    'auto' => 'Toyota Corolla 2017',
    'imagen' => 'img/puerta.jpg',
    'costo' => '120.00',
    'unidades' => 4,
    'observaciones' => 'Sin rayones, color original.'
  ]
];

$parte = $partes[$id_parte] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle de Parte</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f8f8;
      padding: 20px;
    }
    .detalle-parte {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .detalle-parte img {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
      border-radius: 8px;
    }
    .detalle-parte h2 {
      margin-top: 15px;
    }
    .detalle-parte p {
      margin: 5px 0;
    }
    .comentarios {
      margin-top: 30px;
    }
    .comentario {
      background: #eef1f5;
      padding: 10px;
      margin-bottom: 15px;
      border-left: 4px solid #4361ee;
      border-radius: 5px;
    }
    form {
      background: #fff;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    form input, form textarea {
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
    }
    form button {
      background-color: #2a9d8f;
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 4px;
    }
  </style>
</head>
<body>

<div class="detalle-parte">
  <?php if ($parte): ?>
    <img src="<?= $parte['imagen'] ?>" alt="<?= $parte['nombre'] ?>">
    <h2><?= $parte['nombre'] ?></h2>
    <p><strong>Auto:</strong> <?= $parte['auto'] ?></p>
    <p><strong>Costo:</strong> $<?= $parte['costo'] ?></p>
    <p><strong>Unidades disponibles:</strong> <?= $parte['unidades'] ?></p>
    <p><strong>Observaciones:</strong> <?= $parte['observaciones'] ?></p>

    <div class="comentarios">
      <h3>Comentarios</h3>

      <!-- Comentarios simulados -->
      <div class="comentario">
        <p><strong>Ana:</strong> Muy buen estado, gracias por la atención.</p>
      </div>
      <div class="comentario">
        <p><strong>Luis:</strong> ¿Tienen otro color?</p>
      </div>

      <!-- Formulario de comentarios -->
      <form action="guardar_comentario.php" method="post">
        <input type="hidden" name="id_parte" value="<?= $id_parte ?>">
        <input type="text" name="nombre" placeholder="Tu nombre" required>
        <textarea name="comentario" placeholder="Escribe tu comentario..." required></textarea>
        <label>
          <input type="checkbox" name="publicar" value="1"> Publicar ahora
        </label>
        <button type="submit">Enviar Comentario</button>
      </form>
    </div>
  <?php else: ?>
    <p>Parte no encontrada.</p>
  <?php endif; ?>
</div>

</body>
</html>
