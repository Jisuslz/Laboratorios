<?php
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit;
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar datos del formulario
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_STRING);

    if (!empty($usuario) && !empty($clave)) {
        if (authenticate($usuario, $clave)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: bienvenida.php");
            exit;
        } else {
            $error_message = "Credenciales incorrectas";
        }
    } else {
        $error_message = "Por favor, ingrese usuario y contraseña";
    }
}

// Función de autenticación simulada
function authenticate($usuario, $clave) {
    // Simulación de una consulta a la base de datos para verificar las credenciales
    $usuarios = array(
        "jisus" => "1q2w3e4r5t"
    );

    return isset($usuarios[$usuario]) && $usuarios[$usuario] === $clave;
}
?>

<!DOCTYPE html>
<html lang="en">
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
        <h1>Login de Usuario</h1>
        <?php if(isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" required><br>
            <label for="nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="nacimiento" name="nacimiento"><br>
            <label>Género:</label>
            <input type="radio" id="masculino" name="genero" value="masculino">
            <label for="masculino">Masculino</label>
            <input type="radio" id="femenino" name="genero" value="femenino">
            <label for="femenino">Femenino</label><br>
            <input type="radio" id="otro" name="genero" value="otro">
            <label for="otro">Otro / Prefiero no decirlo</label><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
