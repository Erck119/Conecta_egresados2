<?php
require 'config.php';
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['num_con'])) {
    header("Location: login.php");
    exit();
}

$num_con = $_SESSION['num_con']; // Número de control del usuario logueado

// Validar que se haya enviado un archivo
if (isset($_FILES['archivito']) && $_FILES['archivito']['error'] === UPLOAD_ERR_OK) {
    // Ruta para almacenar las imágenes
    $ruta = "imagenesCredencial/" . $num_con . "/";

    // Crear directorio si no existe
    if (!is_dir($ruta)) {
        mkdir($ruta, 0755, true);
    }

    // Información del archivo subido
    $archivoName = $_FILES['archivito']['name'];
    $archivoTemp = $_FILES['archivito']['tmp_name'];
    $archivoSize = $_FILES['archivito']['size'];
    $archivoType = mime_content_type($archivoTemp);

    // Validar tipo de archivo (solo imágenes)
    $formatosPermitidos = ['image/jpeg', 'image/png'];
    if (!in_array($archivoType, $formatosPermitidos)) {
        echo "Error: El archivo debe ser una imagen en formato JPEG o PNG.";
        exit();
    }

    // Validar tamaño del archivo (máximo 5 MB)
    if ($archivoSize > 5 * 1024 * 1024) {
        echo "Error: El archivo no debe exceder los 5 MB.";
        exit();
    }

    // Normalizar el nombre del archivo
    $archivoName = quitaacentos(utf8_decode($archivoName));
    $archivoName = strtolower($archivoName);

    // Mover el archivo a la carpeta correspondiente
    if (move_uploaded_file($archivoTemp, $ruta . $archivoName)) {
        // Redimensionar la imagen
        imagenproductos($ruta . $archivoName);

        // Conectar a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'conecta_egresados');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Escapar el nombre del archivo para evitar inyecciones SQL
        $archivoName = $conexion->real_escape_string($archivoName);

        // Actualizar la base de datos con la nueva imagen
        $sql = "UPDATE foto SET contenido='$archivoName' WHERE num_con='$num_con'";
        if ($conexion->query($sql) === TRUE) {
            echo "Imagen subida y registrada correctamente.";
        } else {
            echo "Error al actualizar la base de datos: " . $conexion->error;
        }

        $conexion->close();
    } else {
        echo "Error: No se pudo mover el archivo.";
    }
} else {
    echo "Error: No se recibió ningún archivo.";
}

// Función para redimensionar imágenes
function imagenproductos($imagen)
{
    $info = new SplFileInfo($imagen);
    $uploadedfile = $imagen;
    $ext = $info->getExtension();
    $name = str_ireplace("." . $ext, "", $info->getFilename());
    $ruta = $info->getPath();
    $quality = 75;
    $newwidth = 500;

    // Crear recurso de imagen dependiendo del formato
    if ($ext == "jpg" || $ext == "jpeg") {
        $src = imagecreatefromjpeg($uploadedfile);
    } else if ($ext == "png") {
        $src = imagecreatefrompng($uploadedfile);
    } else {
        return; // Si no es un formato soportado, salir
    }

    // Obtener dimensiones originales y calcular nuevas
    list($width, $height) = getimagesize($uploadedfile);
    $newheight = ($height / $width) * $newwidth;

    // Crear una nueva imagen redimensionada
    $tmp = imagecreatetruecolor($newwidth, $newheight);
    $color = imagecolorallocatealpha($tmp, 255, 255, 255, 1); // Fondo blanco
    imagefill($tmp, 0, 0, $color);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // Guardar la nueva imagen
    imagejpeg($tmp, $ruta . '/' . $name . ".jpg", $quality);

    // Liberar memoria
    imagedestroy($tmp);
    imagedestroy($src);

    // Eliminar el archivo original si es PNG o JPEG
    if ($ext == "png" || $ext == "jpeg") {
        unlink($uploadedfile);
    }
}

// Función para quitar acentos y caracteres no válidos
function quitaacentos($cual)
{
    $search2 = array('"', '!', '¡', '|', '<', '>', '#', '$', '%', '&', '°', '*', 'ç', '+', '?', '¿', ';', ':', '/', '\\', '(', ')', '´');
    $cual = str_replace($search2, "", $cual);
    $search = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', ' ', '_', 'Ñ', 'ñ');
    $replace = array('A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', '-', '_', 'N', 'n');
    return str_replace($search, $replace, $cual);
}
?>
