<?php 
session_start();

            try {

                if(isset($_SESSION["username_logueado"])){
            
                    $cardNroValue = "";
                    $cardCvValue = "";
                    $cardFvValue = "";

                    $dbuser = "root";
                    $dbpassword = "";
            
                    $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
                    $dbuser = "";
                    $dbpassword = "";
                    $query = "SELECT cardNro, cardCv, cardFv FROM `users` WHERE username = :username;";
                    $q =  $conn->prepare($query);
                    $result = $q->execute(array(
                        ':username' => $_SESSION["username_logueado"],
                    ));

                    $row = $q->fetch();
                    $cardNroValue = $row["cardNro"];
                    $cardCvValue = $row["cardCv"];
                    $cardFvValue = $row["cardFv"];
                }

                if(isset($_POST["cardNro"]) && isset($_POST["cardCv"]) && isset($_POST["cardFv"]) ){
                    $cardNro = $_POST["cardNro"];
                    $cardCv = $_POST["cardCv"];
                    $cardFv = $_POST["cardFv"];

                    $cardNroValue = $cardNro;
                    $cardCvValue = $cardCv;
                    $cardFvValue = $cardFv;


                    $dbuser = "root";
                    $dbpassword = "";
            
                    $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
                    $dbuser = "";
                    $dbpassword = "";

                    $query = "UPDATE `users` SET cardNro=:cardNro, cardCv=:cardCv, cardFv=:cardFv WHERE username=:username";
                    $q =  $conn->prepare($query);
                    $result = $q->execute(array(
                        ':cardNro' => $cardNro,
                        ':cardCv' => $cardCv,
                        ':cardFv' => $cardFv,
                        ':username' => $_SESSION["username_logueado"]
                    ));

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
            <a href="index.php">Home</a>
        <h2>Datos personales</h2>
        <form action="" method="post">
            Nro tarjeta <input type="text" name="cardNro" value="<?php echo $cardNroValue; ?>"> <br/>
            CVC <input type="text" name="cardCv" value="<?php echo $cardCvValue; ?>"> <br/>
            Fecha de vencimiento <input type="text" name="cardFv" value="<?php echo $cardFvValue; ?>"> <br/>
            <input type="submit" value="Actualizar"> <br/>
        </form>
    </body>
</html>