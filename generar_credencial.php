<?php
require 'config.php'; // Aquí se obtiene la conexión a la base de datos
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

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar el nombre del archivo de la foto en la base de datos
$sql = "SELECT foto FROM documentos WHERE num_con = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $num_con);
$stmt->execute();
$result = $stmt->get_result();

$foto = $fotoPredeterminada; // Valor por defecto si no hay foto registrada
if ($row = $result->fetch_assoc()) {
    $nombreFoto = $row['foto'];

    // Verificar si el nombre del archivo no está vacío y tiene una extensión válida
    if (!empty($nombreFoto) && preg_match('/\.(jpg|jpeg|png)$/i', $nombreFoto)) {
        $rutaImagen = "C:/xampp/htdocs/conecta_egresados/documentos/$num_con/$nombreFoto";
        if (file_exists($rutaImagen)) {
            $foto = realpath($rutaImagen); // Obtener la ruta absoluta
        } else {
            error_log("Imagen no encontrada: $rutaImagen");
        }
    }
}
$stmt->close();

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
        $pdf->Image($foto, 59, 42, 94, 91); // Ajustar según diseño
    }
}

$conn->close();
$pdf->Output('I', 'Credencial_Egresado.pdf');
?>
