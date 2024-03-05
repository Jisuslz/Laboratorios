<?php
$error_message = ""; // Inicializamos la variable de mensaje de error como una cadena vacía

if (
    isset($_POST["nombre"])
    && isset($_POST["documento"])
    && isset($_POST["usuario"])
    && isset($_POST["contraseña"])
) {
    $nombre = $_POST["nombre"];
    $documento = $_POST["documento"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // Validar la contraseña
    if (
        strlen($contraseña) < 8 ||
        !preg_match("#[a-z]+#", $contraseña) ||
        !preg_match("#[A-Z]+#", $contraseña) ||
        !preg_match("#\W+#", $contraseña)
    ) {
        $error_message = "La contraseña debe contener al menos 8 caracteres, una mayúscula, una minúscula y un carácter especial.";
    } else {
        // Generar un valor de salt aleatorio
        $salt = uniqid(mt_rand(), true);

        // Combinar la contraseña con el salt
        $contraseñaConSalt = $contraseña . $salt;

        // Cifrar la contraseña combinada con SHA2
        $contraseñaCifrada = hash('sha256', $contraseñaConSalt);

        // Conexión a la base de datos
        $dbuser = "root";
        $dbpassword = "";
        //include "/opt/lampp/htdocs/Laboratorios/Laboratorio2/config.php";

        $conn = new PDO("mysql:host=localhost;dbname=umanizales", $dbuser, $dbpassword);

        // Consulta preparada para insertar el usuario con la contraseña cifrada y el salt
        $query = "INSERT INTO `usuario` (`id`, `nombre`, `documento`, `usuario`, `contraseña`, `salt`) VALUES (NULL, ?, ?, ?, ?, ?)";
        $q = $conn->prepare($query);
        $result = $q->execute([$nombre, $documento, $usuario, $contraseñaCifrada, $salt]);

        if ($result) {
            $error_message = "Usuario registrado correctamente.";
        } else {
            $error_message =  "Error al registrar el usuario.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de cuenta</title>
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
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
        <h1>Creación de cuenta</h1>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required><br>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br>
            <?php if(!empty($error_message)) echo "<p class='error-message'>$error_message</p>"; ?> <!-- Mostramos el mensaje de error si existe -->
            <input type="submit" value="Registrarme">
            <a href="<?php echo urlencode('acceso.php'); ?>" class="back-link">Volver a la página de acceso</a>
        </form>
    </div>
</body>
</html>
