<?php
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['usuario'])) {
    header("Location: CRUD.php");
    exit;
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar datos del formulario
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $contraseña = filter_input(INPUT_POST, 'contraseña', FILTER_SANITIZE_STRING);

    // Conectar a la base de datos
    $dbuser = "root";
    $dbpassword = "";
    //include "/opt/lampp/htdocs/Laboratorios/Laboratorio2/config.php";

    $conn = new PDO("mysql:host=localhost;dbname=umanizales", $dbuser, $dbpassword);

    // Consultar la base de datos para verificar las credenciales del usuario
    $query = "SELECT * FROM usuario WHERE usuario = :usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verificar la contraseña con el valor de sal
        $stored_password = $user['contraseña'];
        $stored_salt = $user['salt'];
        $hashed_password = hash('sha256', $contraseña . $stored_salt);

        if ($hashed_password === $stored_password) {
            $_SESSION['usuario'] = $usuario;
            header("Location: CRUD.php");
            exit;
        } else {
            $error_message = "Credenciales incorrectas";
        }
    } else {
        $error_message = "Credenciales incorrectas";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 5px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <?php if(isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br>
            <input type="submit" value="Login">
        </form>
        <a href="registro.php" class="link-button">Registrarse</a>
        <a href="contacto.php" class="link-button">Contacto</a>
    </div>
</body>
</html>


