<?php
// Obtener los datos enviados por la petición AJAX
require("config.php");
// Conectar a la base de datos (asumiendo que ya tienes una conexión establecida)

// Consultar los datos de la tabla "datos" con el ID proporcionado
$query_datos = "SELECT * FROM datos WHERE id = '$id'";
$result_datos = mysqli_query($conexion, $query_datos);

// Verificar si se encontró un registro con el ID proporcionado
if ($row_datos = mysqli_fetch_assoc($result_datos)) {
    $id_num_con = $row_datos['id'];
    $id_datos = $row_datos['id'];

    // Insertar los datos en la tabla "credencial"
    $query_credencial = "INSERT INTO credencial (id, id_num_con, id_datos, id_docs) 
                        VALUES ('$id', '$id_num_con', '$id_docs')";
    
    if (mysqli_query($conexion, $query_credencial)) {
        echo "Cambios guardados correctamente.";
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($conexion);
    }
} else {
    echo "No se encontraron datos en la tabla 'datos' con el ID proporcionado.";
}

// Cerrar la conexión a la base de datos

?>