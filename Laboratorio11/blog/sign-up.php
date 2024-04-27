<html>
    <head>
        <title>Sign up</title>
    </head>
    <body>
        <?php 
            try {
                if(isset($_POST["username"]) && isset($_POST["password"])){
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $dbuser = "root";
                    $dbpassword = "";
            
                    $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
                    $dbuser = "";
                    $dbpassword = "";
                    $query = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, :username, :password);";
                    $q =  $conn->prepare($query);
                    $result = $q->execute(array(
                        ':username' => $username,
                        ':password' => sha1($password)
                    ));
                }
            }
            catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage();
            }
        ?>
        <h1>Sign up</h1>
        <form action="" method="post">
            user name <input type="text" name="username"> <br/>
            Password <input type="password" name="password"> <br/>
            <input type="submit" value="Registrarme"> <br/>
        </form>
    </body>
</html>