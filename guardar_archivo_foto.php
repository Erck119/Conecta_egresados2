<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    if (!$conn) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Validar que los campos requeridos están presentes
    $titulo = $_POST['titulo'] ?? '';
    if (empty($titulo)) {
        die("El campo 'Número de Control' es obligatorio.");
    }

    // Validar que se haya subido un archivo
    if (!isset($_FILES['archivito']) || $_FILES['archivito']['error'] !== UPLOAD_ERR_OK) {
        die("No se ha subido una imagen o hubo un error en la subida.");
    }

    // Recoger los datos del archivo
    $archivoTmp = $_FILES['archivito']['tmp_name'];
    $archivoNombre = $_FILES['archivito']['name'];
    $archivoTipo = $_FILES['archivito']['type'];
    $archivoContenido = file_get_contents($archivoTmp);

    // Asegurar que el archivo sea una imagen válida
    if (!in_array($archivoTipo, ['image/jpeg', 'image/png', 'image/gif'])) {
        die("Solo se permiten imágenes JPEG, PNG o GIF.");
    }

    // Usar una consulta preparada para prevenir inyección SQL
    $stmt = $conn->prepare("INSERT INTO foto (titulo, contenido, tipo) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $contenidoEscapado = addslashes($archivoContenido); // Por seguridad adicional
    $stmt->bind_param("sss", $titulo, $contenidoEscapado, $archivoTipo);

    if ($stmt->execute()) {
        echo "<script>alert('Foto agregada exitosamente'); window.location.href='descargar.php';</script>";
    } else {
        die("Error al guardar el archivo: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
