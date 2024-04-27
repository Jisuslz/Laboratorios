<?php
session_start();

try {
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $dbuser = "root";
        $dbpassword = "";

        $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
        $dbuser = "";
        $dbpassword = "";
        $query = "SELECT username, password FROM `users` WHERE username = :username AND password = :password;";
        $q =  $conn->prepare($query);
        $result = $q->execute(array(
            ':username' => $username,
            ':password' => sha1($password)
        ));
        if($q->rowCount() == 1){
            $_SESSION["username_logueado"] = $username;
            $_SESSION["usuario_esta_logueado"] = true;
            header("location: personal-info.php");
        }
        else {
            echo "Usuario o clave no validos";
        }
    }
}
catch(Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage();
}
?>
<html>
    <head>
        <title>Sign up</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="" method="post">
            user name <input type="text" name="username"> <br/>
            Password <input type="password" name="password"> <br/>
            <input type="submit" value="Login"> <br/>
        </form>
    </body>
</html>