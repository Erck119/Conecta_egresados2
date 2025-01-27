<?php
require 'config.php';
require 'vendor/autoload.php'; // Cargar dependencias

use setasign\Fpdi\Fpdi; // Declarar uso de FPDI aquí

session_start();

// Datos del usuario
$num_con = $_SESSION['num_con'] ?? '';
$nombre = $_SESSION['nombre'] ?? '';
$ap_p = $_SESSION['ap_p'] ?? '';
$ap_m = $_SESSION['ap_m'] ?? '';
$carrera = $_SESSION['carrera'] ?? 'No especificado';
$ano_egre = $_SESSION['ano_egre'] ?? 'No especificado';
$fotoPredeterminada = 'C:/xampp/htdocs/conecta_egresados/images/Predeterminada/descargar.jpeg';

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "conecta_egresados");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Buscar la carpeta de fotos para el usuario
$rutaImagen = "C:/xampp/htdocs/conecta_egresados/imagenesCredencial/$num_con/";

// Obtener todos los archivos de la carpeta
$archivos = scandir($rutaImagen);

// Filtrar para encontrar una imagen (suponiendo que sea jpg, png o jpeg)
$foto = $fotoPredeterminada; // Valor predeterminado en caso de que no se encuentre ninguna imagen

foreach ($archivos as $archivo) {
    // Verificar si es una imagen
    if (in_array(strtolower(pathinfo($archivo, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'])) {
        $foto = $rutaImagen . $archivo; // Usamos la primera imagen válida que encontremos
        break; // Salimos del loop si encontramos una imagen
    }
}

// Ruta al archivo PDF base
$templatePath = 'C:/xampp/htdocs/conecta_egresados/images/CredencialDigital.pdf';
if (!file_exists($templatePath)) {
    die('El archivo base no se encuentra.');
}

// Generación del PDF
$pdf = new Fpdi();
$pageCount = $pdf->setSourceFile($templatePath);

for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $pdf->AddPage('P', 'A4');
    $templateId = $pdf->importPage($pageNo);
    $pdf->useTemplate($templateId, 0, 0, 210, 297);

    if ($pageNo === 1) {
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetXY(25, 150);
        $pdf->Cell(190, 10, "$nombre $ap_p $ap_m", 0, 1, 'C');

        $pdf->SetXY(42, 170);
        $pdf->Cell(190, 10, "$carrera", 0, 1, 'C');

        $pdf->SetXY(10, 200);
        $pdf->Cell(190, 10, "$ano_egre", 0, 1, 'C');

        $pdf->SetXY(10, 250);
        $pdf->Cell(190, 10, "$num_con", 0, 1, 'C');

        // Cargar la imagen (se usará la predeterminada si no se encuentra ninguna imagen)
        $pdf->Image($foto, 59,42, 94,91); // Ajustar según diseño
    }
}

$conn->close();
$pdf->Output('I', 'Credencial_Egresado.pdf');
?>
