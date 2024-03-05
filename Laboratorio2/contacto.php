<?php
// Verifica si se recibieron datos del formulario
if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['mensaje'])) {
    // Recibe los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Conexión a la base de datos

    include "config.php";

    try {
        // Conexión a la base de datos
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO mensajes_contacto (nombre, email, telefono, mensaje) VALUES (:nombre, :email, :telefono, :mensaje)";
        $statement = $conn->prepare($sql);
        
        // Bind parameters
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':mensaje', $mensaje);

        // Ejecuta la consulta
        $statement->execute();

        // Redirige al usuario a una página de confirmación
        header('Location: contacto.html');
        exit();
    } catch(PDOException $e) {
        echo "Error al insertar el mensaje: " . $e->getMessage();
    }

    // Cierra la conexión a la base de datos
    $conn = null;
} else {
    // Si no se recibieron todos los datos del formulario, muestra un mensaje de error
    echo "No se han recibido todos los datos del formulario.";
}
?>
