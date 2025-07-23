<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - Rastro Partes</title>
  <style>
    :root {
      --primary: #2563eb;
      --primary-hover: #1d4ed8;
      --gray: #f3f4f6;
      --dark: #111827;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--gray);
      margin: 0;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 40px 20px;
    }

    h1 {
      text-align: center;
      color: var(--dark);
      margin-bottom: 20px;
    }

    h2 {
      color: var(--primary);
      margin-top: 40px;
    }

    p {
      color: #374151;
      line-height: 1.6;
    }


    .highlight {
      font-weight: bold;
      color: var(--primary);
    }

    .authors {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      margin-top: 30px;
    }

    .authors h3 {
      margin-bottom: 15px;
      color: var(--dark);
    }

    .authors .member {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 6px solid var(--primary);
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .authors .member p:first-child {
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 1.1rem;
    }

    .project-origin {
    position: relative;
    padding: 10px 20px;
    font-family: Arial, sans-serif;
    line-height: 1.6;
    }

    .img-left {
    float: left;
    width: 40%;
    margin: 0 15px 20px 0;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    }

    .img-right {
    float: right;
    width: 40%;
    margin: 20px 0 0 15px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    }

    .project-origin::after {
    content: "";
    display: table;
    clear: both;
    }

    @media (max-width: 768px) {
    .img-left, .img-right {
        float: none;
        width: 100%;
        margin: 10px 0;
    }
    }


  </style>
</head>
<body>

  <div class="container">
    <h1>Bienvenidos a Rastro Partes</h1>
    <p>
      <strong>Rastro Partes</strong> es una plataforma enfocada en facilitar el inventario, búsqueda y gestión de partes de vehículos. Su propósito principal es ayudar a talleres, mecánicos y entusiastas a encontrar piezas de forma rápida y eficiente.
    </p>

    <div class="project-origin">
    <h2>¿Cómo nació el proyecto?</h2>
    <br>
    <img src="../imagenes/vidrios.jpeg" alt="Vidrios" class="img-left" />
    <div>
    <p>
        La idea de desarrollar este proyecto surgió de una observación casual durante una visita a una pequeña ferretería local 
        ubicada en las afueras de la ciudad. El dueño, un hombre mayor que llevaba décadas manejando su negocio, nos contó entre 
        risas cómo aún anotaba sus ventas en una libreta desgastada, llena de números y tachones. Nos sorprendió saber que, a pesar 
        de los avances tecnológicos, muchos negocios similares aún dependían de métodos manuales para controlar su inventario, 
        ventas y pedidos. Esto nos llevó a investigar más a fondo, visitando más de diez negocios similares en distintos puntos 
        del país. Durante estas visitas, tomamos nota de los principales dolores de cabeza de los propietarios: pérdida de productos 
        por falta de control, dificultad para hacer cierres de caja, problemas con el registro de entradas y salidas, e incluso la 
        imposibilidad de saber qué productos estaban por agotarse. 
        <br><br>
        Motivados por estas realidades, decidimos crear un sistema que no solo resolviera estos problemas, sino que también fuera 
        fácil de usar, visualmente atractivo y accesible desde diferentes dispositivos. Queríamos que cualquier comerciante, sin 
        importar su nivel técnico, pudiera aprovecharlo al máximo. En nuestras primeras reuniones de lluvia de ideas, surgieron 
        preguntas como: ¿Cómo hacemos para que el sistema sea realmente útil? ¿Qué funciones serían imprescindibles desde el primer día? 
        ¿Cómo podríamos diseñar una interfaz tan intuitiva que no necesite manual? Gracias a esas preguntas y a las ideas aportadas 
        por cada miembro del equipo, se fue moldeando lo que hoy conocemos como Rastro Partes. Este sistema no nació de una necesidad 
        técnica, sino de una necesidad humana: la de simplificar la vida de quienes dedican su tiempo y esfuerzo a mantener vivos 
        sus negocios. Cada botón, cada pantalla y cada función fue pensada no desde la teoría, sino desde la práctica, escuchando 
        directamente a quienes serán los verdaderos usuarios del sistema. 
        <br><br>
        <img src="../imagenes/puertas.jpg" alt="Puertas" class="img-right" />
        Además, este proyecto también significó para nosotros una oportunidad de crecimiento académico y profesional. Fue el primer 
        desarrollo donde pusimos en práctica herramientas y metodologías aprendidas en clase, como el trabajo con bases de datos, 
        diseño centrado en el usuario, y desarrollo colaborativo. Las decisiones de diseño, funcionalidad e implementación fueron 
        consensuadas y evolucionaron con el tiempo, conforme entendíamos mejor el contexto de uso. La motivación detrás de cada línea 
        de código era clara: brindar una solución real, efectiva y adaptable. Este proyecto no solo fue una entrega académica, sino 
        el inicio de una visión a largo plazo donde la tecnología puede y debe servir a quienes más lo necesitan.  
        
    </p>
    </div>
    </div>
    <br>
    <h2>Autores del Proyecto</h2>
    <div class="authors">
    <h3>Equipo de desarrollo:</h3>
        <div class="member">
            <p><span class="highlight">Yini Pan</span> – Coordinadora General, Frontend y Diseño UX</p>
            <p>
                Yini Pan asumió el rol de coordinadora general del proyecto, supervisando cada fase de desarrollo y asegurando la comunicación efectiva entre los miembros del equipo. 
                Además, lideró el diseño del frontend y la experiencia de usuario (UX), definiendo la identidad visual del sistema Rastro Partes. 
                Estableció criterios de usabilidad, organizó la estructura de navegación y seleccionó los estilos visuales adecuados para ofrecer una interfaz limpia, moderna y funcional. 
                Su trabajo permitió una experiencia coherente en todas las vistas del sistema, facilitando la interacción por parte de los usuarios finales.
            </p>
        </div>
        
        <div class="member">
            <p><span class="highlight">Yoel Samaniego</span> – Backend y Base de Datos (Login y Registro)</p>
            <p>
            Yoel Samaniego fue el encargado de desarrollar el sistema de autenticación, incluyendo el registro de nuevos usuarios y el login con verificación segura. 
            Diseñó y estructuró la base de datos para almacenar la información de los usuarios, validó formularios y manejó errores comunes del lado del servidor. 
            También implementó mecanismos de encriptación para proteger contraseñas y reforzar la seguridad. 
            Su código backend está construido en PHP, trabajando en conjunto con MySQL para garantizar una gestión eficiente y segura de los accesos.
            </p>
        </div>

        <div class="member">
            <p><span class="highlight">Eric Ruiz</span> – Documentación y Backend</p>
            <p>
            Eric Ruiz se enfocó en dos áreas fundamentales: la elaboración de documentación técnica y el apoyo en el backend del sistema. 
            Fue el responsable de registrar todo el proceso de desarrollo, describir los módulos del proyecto, flujos de datos, 
            y el funcionamiento general del sistema. También participó en la programación de funciones del backend, principalmente 
            en operaciones relacionadas con el inventario y validaciones de datos. Su participación ayudó a mantener la coherencia y claridad del proyecto.
            </p>
        </div>

        <div class="member">
            <p><span class="highlight">Gabriel González</span> – Backend (Manejo de Inventario)</p>
            <p>
            Gabriel González fue el principal desarrollador del módulo de inventario de partes, núcleo funcional del sistema. 
            Programó las funciones para registrar nuevas piezas, editar registros existentes, eliminarlos y listarlos desde la base de datos. 
            También trabajó en la conexión con el frontend, asegurando que los datos ingresados por los usuarios se reflejaran correctamente en la interfaz. 
            Su enfoque fue asegurar estabilidad en las operaciones CRUD y una lógica eficiente en el manejo de la información almacenada.
            </p>
        </div>
        </div>
    <h2>¿Qué encontrarás en esta página?</h2>
    <p>
      Explora marcas, modelos, piezas disponibles, y accede a funciones como login, registro de nuevos usuarios y gestión de inventario. Todo con una interfaz clara, intuitiva y responsiva.
    </p>
  </div>

<?php include 'footer.php'; ?>
</body>
</html>
