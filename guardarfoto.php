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
    $ruta = "documentos/" . $num_con . "/";

    // Crear directorio si no existe
    if (!is_dir($ruta)) {
        mkdir($ruta, 0755, true);
    }

    // Información del archivo subido
    $archivoName = $_FILES['archivito']['name'];
    $archivoTemp = $_FILES['archivito']['tmp_name'];
    $archivoSize = $_FILES['archivito']['size'];
    $archivoType = mime_content_type($archivoTemp);

    // Obtener la extensión real del archivo
    $ext = strtolower(pathinfo($archivoName, PATHINFO_EXTENSION));

    // Validar tipo de archivo (solo imágenes)
    $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Agregados más formatos
    if (!in_array($ext, $formatosPermitidos)) {
        echo "Error: El archivo debe ser una imagen válida (JPG, PNG, GIF, WEBP).";
        exit();
    }

    // Validar tamaño del archivo (máximo 5 MB)
    if ($archivoSize > 5 * 1024 * 1024) {
        echo "Error: El archivo no debe exceder los 5 MB.";
        exit();
    }

    // Normalizar el nombre del archivo (sin acentos ni caracteres especiales)
    $archivoName = quitaacentos(pathinfo($archivoName, PATHINFO_FILENAME)) . '.' . $ext;

    // Ruta final del archivo
    $rutaFinal = $ruta . $archivoName;

    // Mover el archivo a la carpeta correspondiente
    if (move_uploaded_file($archivoTemp, $rutaFinal)) {
        // Redimensionar la imagen manteniendo su formato original
        imagenproductos($rutaFinal, $ext);

        // Conectar a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'conecta_egresados');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Escapar el nombre del archivo para evitar inyecciones SQL
        $archivoName = $conexion->real_escape_string($archivoName);

        // Actualizar la base de datos con la nueva imagen
        $sql = "UPDATE documentos SET foto='$archivoName' WHERE num_con='$num_con'";
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

// Función para redimensionar imágenes sin cambiar la extensión
function imagenproductos($imagen, $ext)
{
    list($width, $height) = getimagesize($imagen);
    $newwidth = 500;
    $newheight = ($height / $width) * $newwidth;

    $tmp = imagecreatetruecolor($newwidth, $newheight);
    $color = imagecolorallocatealpha($tmp, 255, 255, 255, 1);
    imagefill($tmp, 0, 0, $color);

    // Crear imagen según su tipo
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $src = imagecreatefromjpeg($imagen);
            break;
        case 'png':
            $src = imagecreatefrompng($imagen);
            imagealphablending($tmp, false);
            imagesavealpha($tmp, true);
            break;
        case 'gif':
            $src = imagecreatefromgif($imagen);
            break;
        case 'webp':
            $src = imagecreatefromwebp($imagen);
            break;
        default:
            return;
    }

    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // Guardar la imagen redimensionada en su formato original
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($tmp, $imagen, 75);
            break;
        case 'png':
            imagepng($tmp, $imagen, 6);
            break;
        case 'gif':
            imagegif($tmp, $imagen);
            break;
        case 'webp':
            imagewebp($tmp, $imagen, 75);
            break;
    }

    // Liberar memoria
    imagedestroy($tmp);
    imagedestroy($src);
}

// Función para quitar acentos y caracteres no válidos en nombres de archivos
function quitaacentos($cual)
{
    $search = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', ' ', '_', 'Ñ', 'ñ');
    $replace = array('A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', '-', '_', 'N', 'n');
    return str_replace($search, $replace, $cual);
}
?>
