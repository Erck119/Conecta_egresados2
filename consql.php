<?php
// Datos de conexión a la base de datos (ajusta estos valores con los de tu servidor)
require ("config.php");
// Obtener el número de ID ingresado por el usuario desde el frontend (HTML)
if(isset($_POST['num_id'])){
    $num_id = $_POST['num_id'];

    // Conexión a la base de datos
  

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener el campo "estado" correspondiente al "num_con" ingresado
    $sql = "SELECT estado FROM datos WHERE num_con = $num_id";
    $result = $conn->query($sql);

    // Verificar si se encontró un registro con el "num_con" ingresado
    if ($result->num_rows > 0) {
        // Obtener el resultado de la consulta
        $row = $result->fetch_assoc();
        $estado = $row['estado'];
        echo "El estado correspondiente al número de ID $num_id es: $estado";
    } else {
        echo "No se encontró ningún registro con el número de ID ingresado.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
