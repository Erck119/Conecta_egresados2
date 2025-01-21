<?php
require 'config.php';

function obtenerArchivoDesdeBD($id) {
    // Conexión a la base de datos (ajusta los valores según tu configuración)
    $host = 'localhost';
    $database = 'reglog';
    $username = 'root';
    $password = '';

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta para obtener los datos del archivo desde la base de datos
    $sql = "SELECT nombre_archivo, tipo_archivo, datos_archivo FROM archivos WHERE id = $id"; 

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreArchivo = $row['nombre_archivo'];
        $tipoArchivo = $row['tipo_archivo'];
        $datosArchivo = $row['datos_archivo'];

        // Establecer los encabezados para la descarga del archivo
        header("Content-type: $tipoArchivo");
        header("Content-Disposition: attachment; filename=$nombreArchivo");
        
        // Imprimir los datos del archivo
        echo $datosArchivo;
    }

    $conn->close();
}

// Obtener el ID del archivo desde la URL
if (isset($_GET['id'])) {
    $archivoID = $_GET['id'];
    obtenerArchivoDesdeBD($archivoID);
} else {
    echo "ID de archivo no proporcionado";
}
?>
