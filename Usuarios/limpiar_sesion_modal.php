<?php
session_start();

// Limpiar específicamente las variables de sesión relacionadas con el modal y errores
unset($_SESSION['errores_usuario']);
unset($_SESSION['abrir_modal']);
unset($_SESSION['form_data']);
unset($_SESSION['es_edicion']);
unset($_SESSION['redireccion_por_error']);
unset($_SESSION['mensaje_exito']);

// Opcional: Puedes enviar una respuesta JSON para confirmar la limpieza.
// Esto es útil para depuración en el navegador.
echo json_encode(['status' => 'success', 'message' => 'Variables de sesión del modal limpiadas.']);
exit;
?>