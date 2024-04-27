<html>
    <head>
        <title>Busqueda de vuelos por destino</title>
    </head>
    <body>
        <h1>Busqueda de vuelos por destino</h1>
        <form action="" method="GET">
            Destino a buscar: 
            <input type="text" name="destino">
            <input type="submit" value="Buscar">
        </form>
        <?php 
            if(isset($_GET["destino"])){
                $destino = $_GET["destino"];
                echo "Busqueda por $destino <br/><br/>";

                $dbuser = "root";
                $dbpassword = "";
        
                $conn = new PDO("mysql:host=localhost;dbname=aerolinea", $dbuser, $dbpassword);
                
                //Vulnerable
                //$sentencia = "SELECT origen, destino, aerolinea FROM vuelos WHERE destino = '$destino'";

                //Seguro
                $sentencia = "SELECT origen, destino, aerolinea FROM vuelos WHERE destino = :destino;";

                $consultaSQL = $conn->prepare($sentencia);

                $consultaSQL->execute(array(
                    ':destino' => $destino,
                ));
        ?>
        <table border="1">
            <tr>
                <th>
                    Origen
                </th>
                <th>
                    Destino
                </th>
                <th>
                    Aerolinea
                </th>
            </tr>
        <?php
                while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <tr>
                    <td><?php echo $row["origen"] ?></td>
                    <td><?php echo $row["destino"] ?></td>
                    <td><?php echo $row["aerolinea"] ?></td>
                </tr>

        <?php
                }
            }
        ?>
        </table>
    </body>
</html>