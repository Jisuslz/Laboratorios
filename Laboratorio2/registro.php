<?php
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

    // Generar un valor de salt aleatorio
    $salt = uniqid(mt_rand(), true);

    // Combinar la contraseña con el salt
    $contraseñaConSalt = $contraseña . $salt;

    // Cifrar la contraseña combinada con SHA2
    $contraseñaCifrada = hash('sha256', $contraseñaConSalt);

    // Conexión a la base de datos
    include "/opt/lampp/htdocs/config.php";

    $conn = new PDO("mysql:host=localhost;dbname=umanizales", $dbuser, $dbpassword);

    // Consulta preparada para insertar el usuario con la contraseña cifrada y el salt
    $query = "INSERT INTO `usuario` (`id`, `nombre`, `documento`, `usuario`, `contraseña`, `salt`) VALUES (NULL, ?, ?, ?, ?, ?)";
    $q = $conn->prepare($query);
    $result = $q->execute([$nombre, $documento, $usuario, $contraseñaCifrada, $salt]);

    if ($result) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
<h1>Registro de pasajeros</h1>
<hr />
<form action="" method="post">
    Nombre: <input type="text" name="nombre"> <br>
    Documento: <input type="text" name="documento"> <br>
    Usuario: <input type="text" name="usuario"><br>
    Contraseña : <input type="password" name="contraseña">
    <hr>
    <input type="submit" value="Registrarme">
</form>
