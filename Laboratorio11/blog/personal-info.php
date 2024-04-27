<?php 
session_start();

            try {
                if(isset($_POST["username"])){
                    $username = $_POST["username"];

                    $dbuser = "root";
                    $dbpassword = "";
            
                    $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
                    $dbuser = "";
                    $dbpassword = "";
                    $query = "SELECT username, password FROM `users` WHERE username = :username;";
                    $q =  $conn->prepare($query);
                    $result = $q->execute(array(
                        ':username' => $username,
                    ));
                    if($q->rowCount() == 1){
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
        <title>Personal info</title>
    </head>
    <body>
            <h1>Bienvenido <b><?php echo $_SESSION["username_logueado"]; ?></b></h1>
        <h2>Personal info</h2>
        <form action="" method="post">
            user name <input type="text" name="username"> <br/>
            Password <input type="password" name="password"> <br/>
            <input type="submit" value="Login"> <br/>
        </form>
    </body>
</html>