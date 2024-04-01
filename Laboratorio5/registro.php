<?php 
    if(
        isset($_POST["nombre"]) 
        && isset($_POST["documento"]) 
        && isset($_POST["usuario"])
        && isset($_POST["password"]))
    {
        $nombre = $_POST["nombre"];
        $documento = $_POST["documento"];
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $dbuser = "root";
        $dbpassword = "";

        $conn = new PDO("mysql:host=localhost;dbname=aerolinea", $dbuser, $dbpassword);
        $dbuser = "";
        $dbpassword = "";
        $query = "INSERT INTO `usuarios` (`id`, `nombre`, `documento`, `usuario`, `password`) VALUES (NULL, '$nombre', '$documento', '$usuario', '$password');";
        $q =  $conn->prepare($query);
        $result = $q->execute();
    }
?>
<h1>Registro de pasajeros</h1>
<hr/>
<form action="" method="post">
    Nombre: <input type="text" name="nombre"> <br>
    Documento: <input type="text" name="documento"> <br>
    Usuario: <input type="text" name="usuario"><br>
    Password: <input type="password" name="password">
    <hr>
    <input type="submit" value="Registrarme">
</form>