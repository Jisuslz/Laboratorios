<html>
<head>
    <title>Búsqueda de vuelos por destino</title>
</head>
<body>
    <h1>Búsqueda de vuelos</h1>
    <form action="busqueda-vuelos.php" method="GET">
        Destino a buscar:
        <select name="destino">
            <option value="Nueva York">Nueva York</option>
            <option value="Los Ángeles">Los Ángeles</option>
            <option value="Londres">Londres</option>
            <option value="París">París</option>
            <option value="Tokio">Tokio</option>
            <option value="Seúl">Seúl</option>
            <option value="Sídney">Sídney</option>
            <option value="Melbourne">Melbourne</option>
            <option value="Ciudad de México">Ciudad de México</option>
            <option value="Cancún">Cancún</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
    <?php
        if(isset($_GET["destino"])){
            $destino = $_GET["destino"];
            echo "Búsqueda por $destino ";

            $dbuser = 'root';
            $dbpassword = "";

            $conn = new PDO("mysql:host=localhost;dbname=aerolinea",$dbuser, $dbpassword);
            $consultaSQL = $conn->prepare("SELECT origen, destino, aerolinea FROM vuelos WHERE destino = :destino");
            $consultaSQL->bindParam(':destino', $destino);
            $consultaSQL->execute();
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
                    Aerolínea
                </th>
            </tr>
        <?php
                while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
                <tr>
                    <td><?php echo $row["origen"]; ?></td>
                    <td><?php echo $row["destino"]; ?></td>
                    <td><?php echo $row["aerolinea"]; ?></td>
                </tr>
        <?php
                }
        ?>
        </table>
        <?php
            }
        ?>
</body>
</html>
