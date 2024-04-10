<?php
    // Iniciar sesión
    session_start();

    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    if (!isset($_SESSION['usuario'])) {
        header("Location: acceso.php");
        exit;
    }
?>
<?php
// Conectar a la base de datos
$conexion = new mysqli("127.0.0.1:3306", "opensource", "1Q2w3e4r5t**", "umanizales");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$genero = isset($_POST['genero']) ? $_POST['genero'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$aceptoTerminos = isset($_POST['aceptoTerminosYCondiciones']) ? 1 : 0;

// Verificar si se proporcionan los campos obligatorios
if (!empty($nombre) && !empty($email) && !empty($genero) && !empty($carrera) && !empty($password) && isset($_POST['aceptoTerminosYCondiciones'])) {
    // Si se proporcionan los campos obligatorios, se ejecuta la consulta SQL con todos los campos
    //echo "Entra";
    $data = array(
        array(
            'name' => 'fecha_nacimiento',
            'value' => isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : null
        ),
        array(
            'name' => 'semestre',
            'value' => isset($_POST['semestre']) ? $_POST['semestre'] : null
        ),
        array(
            'name' => 'comentarios',
            'value' => isset($_POST['comentarios']) ? $_POST['comentarios'] : null
        ),
        array(
            'name' => 'telefono',
            'value' => isset($_POST['telefono']) ? $_POST['telefono'] : null
        ),
        array(
            'name' => 'archivo_adjunto',
            'value' => isset($_POST['archivo']) ? $_POST['archivo'] : null
        ),
        array(
            'name' => 'pagina_web',
            'value' => isset($_POST['paginaWeb']) ? $_POST['paginaWeb'] : null
        ),
        array(
            'name' => 'valor_rango',
            'value' => isset($_POST['rango']) ? $_POST['rango'] : null
        ),
        array(
            'name' => 'color_favorito',
            'value' => isset($_POST['color']) ? $_POST['color'] : null 
        )
    );
    $campos = "nombre, email, genero, carrera, password, acepto_terminos";
    $valores = "'$nombre', '$email', '$genero', '$carrera', '$password','$aceptoTerminos'";

    foreach ($data as &$e) {
        $e = (object) $e;
        if ($e->value != null) {
            $campos = $campos . ", " . $e->name;
            if($e->name == "valor_rango" || $e->name == "semestre"){
                $valores = $valores . ", " . $e->value;
            }
            else{
                $valores = $valores . ", '" . $e->value . "'";
            }
        }
    }
    // $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : null;
    // $semestre = isset($_POST['semestre']) ? $_POST['semestre'] : null;
    // $comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : null;
    // $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
    // $archivoAdjunto = isset($_POST['archivo']) ? $_POST['archivo'] : null;
    // $paginaWeb = isset($_POST['paginaWeb']) ? $_POST['paginaWeb'] : null;
    // $valorRango = isset($_POST['rango']) ? $_POST['rango'] : null;
    // $colorFavorito = isset($_POST['color']) ? $_POST['color'] : null;

    // Preparar la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO user_cursos ($campos) VALUES ($valores)";
} else {
    // Si no se proporcionan los campos obligatorios, se ejecuta la consulta SQL solo con los campos obligatorios, dejando los demás en blanco o null
    die("Error: Faltan datos por enviar");
}

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar el registro: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>


