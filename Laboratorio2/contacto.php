<?php
  // Recibe los datos del formulario
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $mensaje = $_POST['mensaje'];

  // Configura los datos del correo electrónico
  $destinatario = 'tu@email.com'; //Aquí debes sustituir tu@email.com por tu email
  $asunto = 'Nuevo mensaje de formulario de contacto';
  $cuerpo = "Nombre: $nombre\nEmail: $email\nTeléfono: $telefono\nMensaje: $mensaje";
  $headers = "From: $email\r\nReply-To: $email\r\n";

  // Envía el correo electrónico
  mail($destinatario, $asunto, $cuerpo, $headers);

  // Redirige al usuario a una página de confirmación
  header('Location: confirmacion.html'); // confirmacion.html debe existir
?>
