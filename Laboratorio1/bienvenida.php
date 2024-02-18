<?php
session_start();

// Redirigir al usuario a la página de inicio de sesión si no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario']); // Sanitizar el nombre de usuario
$fechaNacimiento = isset($_SESSION['fecha_nacimiento']) ? $_SESSION['fecha_nacimiento'] : 'No especificada';
$genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : 'No especificado';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $usuario; ?>!</h1>
        <p>Has iniciado sesión correctamente.</p>
        <div class="details">
            <p>Fecha de Nacimiento: <?php echo $fechaNacimiento; ?></p>
            <p>Género: <?php echo $genero; ?></p>
        </div>
    </div>
</body>
</html>
