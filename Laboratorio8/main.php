<?php
session_start();

// Redirigir al usuario a la página de inicio de sesión si no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: acceso.php");
    exit;
}

// Si se ha enviado el formulario de salida, destruir la sesión y redirigir al usuario a la página de acceso
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: acceso.php");
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario']); // Sanitizar el nombre de usuario

// Conectar con la base de datos
include "config.php";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener el nombre y el documento del usuario
    $consulta = "SELECT nombre, documento FROM usuario WHERE usuario = :usuario";
    $statement = $conn->prepare($consulta);
    $statement->bindParam(':usuario', $usuario);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $nombre = $row['nombre'] ?? 'No especificado';
    $documento = $row['documento'] ?? 'No especificado';

    // Consulta para obtener los mensajes de contacto
    $consultaMensajes = "SELECT * FROM mensajes_contacto";
    $statementMensajes = $conn->prepare($consultaMensajes);
    $statementMensajes->execute();
    $mensajes = $statementMensajes->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión con la base de datos
$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <style>
        body {
            background-image: url('Anexos/fondoUM.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh; /* Altura del viewport */
            margin: 0; /* Elimina el margen predeterminado */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: rgba(5, 5, 5, 0.8);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
        }
        .container {
            max-width: 600px;
            margin: 50px auto 0 50px; /* Margen superior, margen derecho, margen inferior, margen izquierdo */
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative; /* Agregado para posicionar los botones */
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin-bottom: 10px;
        }
        .mensaje {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            /* float: center; No es una propiedad válida */
            clear: both; /* Evita que los elementos floten a su alrededor */
            max-width: 70%; /* Limita el ancho del contenedor de mensajes */
        }
        .buttons-container {
            position: absolute;
            top: 20px; /* Ajusta la posición vertical */
            left: 20px; /* Ajusta la posición horizontal */
        }
        .buttons-container form {
            display: inline-block;
        }
    </style>
</head>
<body>       
    <div class="buttons-container">
        <!-- Formulario para redirigir a horariosestudiante.php -->
        <form action="HorariosIngenierias.php" method="GET" style="display: inline;">
            <input type="submit" value="Mi horario">
        </form>
            
        <!-- Formulario para redirigir a horariosdocentes.php -->
        <form action="HorariosDocentes.php" method="GET" style="display: inline;">
            <input type="submit" value="Horarios Docentes">
        </form>

        <!-- Formulario para redirigir a horariosdocentes.php -->
        <form action="calificaciones.php" method="GET" style="display: inline;">
            <input type="submit" value="Historial de notas">
        </form>

         <!-- Formulario para redirigir a matricula.php -->
         <form action="http://localhost/Laboratorios/Laboratorio8/registros/matricula.html" method="GET" style="display: inline;">
            <input type="submit" value="Cursos">
        </form>
    </div>
    <div class="mensaje">
        <form method="post">
            <h1>Bienvenido, <?php echo $usuario; ?>!</h1>
            <p>Has iniciado sesión correctamente.</p>
            <div class="details">
                <p>Nombre: <?php echo $nombre; ?></p>
                <p>Documento: <?php echo $documento; ?></p>
            <input type="submit" name="logout" value="Salir">
        </form>
    </div>
    <!-- Mostrar mensajes -->
    <div class="mensajes">
        <h2>Mensajes de Contacto</h2>
        <?php foreach ($mensajes as $mensaje): ?>
            <div class="mensaje">
                <p><strong>Nombre:</strong> <?php echo $mensaje['nombre']; ?></p>
                <p><strong>Email:</strong> <?php echo $mensaje['email']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $mensaje['telefono']; ?></p>
                <p><strong>Mensaje:</strong> <?php echo $mensaje['mensaje']; ?></p>
                <p><strong>Fecha de envío:</strong> <?php echo $mensaje['fecha_envio']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
