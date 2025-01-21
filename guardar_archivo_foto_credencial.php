<?php

require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha subido un archivo
    if (isset($_FILES['archivito'])) {
        $archivo = $_FILES['archivito']['tmp_name'];
        $tamanio = $_FILES['archivito']['size'];
        $tipo    = $_FILES['archivito']['type'];
        $titulo  = $_POST['titulo'];

        if ($archivo != "none") {
            $contenido = file_get_contents($archivo);
            $contenido = addslashes($contenido);

            // Insertar el archivo en la base de datos
            $query = "INSERT INTO credencial (contenido) VALUES ('$contenido')";
            $resultado = mysqli_query($conn, $query);
            if ($resultado) {
                echo "<script>alert('foto agregada exitosamente ');</script>";
                
            } else {
                echo "NO se ha podido guardar el archivo en la base de datos: " . mysqli_error($conn);
            }
        } else {
            echo "No se ha podido subir el archivo al servidor.";
        }
    }
}

mysqli_close($conn);

?>