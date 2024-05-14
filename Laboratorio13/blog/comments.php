<?php 
session_start();

            try {

                if(isset($_POST["commentText"]) ){
                    $commentText = $_POST["commentText"];

                    $dbuser = "root";
                    $dbpassword = "";
            
                    $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
                    $dbuser = "";
                    $dbpassword = "";

                    $listaBlancaDeTags = "<h1></h1><p></p>";
                    $commentTextSanitizado = strip_tags($commentText, $listaBlancaDeTags);

                    $query = "INSERT INTO `post_comments` (`id`, `user`, `comment`) VALUES (NULL, :user, :commentText);";
                    $q1 =  $conn->prepare($query);
                    $result = $q1->execute(array(
                        ':user' => $_SESSION["username_logueado"],
                        ':commentText' => $commentTextSanitizado,
                    ));
                }

            
            $dbuser = "root";
            $dbpassword = "";
    
            $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
            $dbuser = "";
            $dbpassword = "";
            $query = "SELECT comment, user FROM `post_comments`;";
            $q =  $conn->prepare($query);
            $result = $q->execute();

            // Is the last access over an hour ago?
                if (time() > ($_SESSION['lastaccess'] + 3600))
                {
                    session_unset();
                    session_destroy();
                    echo "LAST ACCESS IF";
                }
                else
                {
                    echo "LAST ACCESS ELSE";
                    $_SESSION['lastaccess'] = time();
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
            <p><?php echo $_SERVER['REMOTE_ADDR'] ?></p>
            <p><?php echo $_SERVER['HTTP_USER_AGENT'] ?></p>
            <p><?php echo $_SESSION['lastaccess'] ?></p>
            <a href="index.php">Home</a>
        <h2>Foro bla bla bla </h2>
        <?php 
            while ($row = $q->fetch()) {
        ?>
            <div>
                <div>
                    <?php echo $row["comment"]; ?>. by <?php echo $row["user"]; ?>
                </div>
            </div> 
            <hr>
        <?php 
            }
        ?>
        <form action="" method="post">
            Agrega un comentario <br>
            <textarea name="commentText" cols="40" rows="5"></textarea> <br/>
            <input type="submit" value="Comentar"> <br/>
        </form>
    </body>
</html>