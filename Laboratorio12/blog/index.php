<?php 
session_start();
?>

<html>
    <head>
        <title>
            Home
        </title>
    </head>
    <body>

    <?php 
        if($_SESSION["username_logueado"])
            ?>
            <h1>Bienvenido <?php echo $_SESSION["username_logueado"]; ?> </h1>
        <?php ?>

        <a href="login.php">Login</a>
        <a href="sign-up.php">Sign up</a>
        <?php 
            if($_SESSION["username_logueado"]){
            ?>
            <a href="personal-info.php">Personal Info</a>
            <a href="comments.php">Ir al foro</a>
        <?php } ?>

    </body>
</html>