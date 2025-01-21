<?php
require 'config.php';
require 'vendor/autoload.php'; // Carga de dependencias de Composer (fpdi)

// Iniciar sesión
session_start();

// Datos del usuario (pueden variar según los valores guardados en sesión)
$nombre = $_SESSION['nombre'] ?? '';
$ap_p = $_SESSION['ap_p'] ?? '';
$ap_m = $_SESSION['ap_m'] ?? '';
$carrera = $_SESSION['carrera'] ?? 'No especificado';
$ano_egre = $_SESSION['ano_egre'] ?? 'No especificado';
$num_con = $_SESSION['num_con'] ?? 'No especificado';
$fotoPredeterminada = '/conecta_egresados/images/Predeterminada.jpeg';

// Ruta del archivo PDF base
$templatePath = 'C:/xampp/htdocs/conecta_egresados/images/CredencialDigital.pdf';

// Establecer la conexión a la base de datos (conexión a MySQL)
$conn = new mysqli("localhost", "root", "", "conecta_egresados");

// Verificar si la conexión a la base de datos fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener la última foto subida
$query = "SELECT * FROM foto ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

// Asegurarse de que la consulta haya tenido éxito antes de procesar los resultados
if ($result && mysqli_num_rows($result) > 0) {
    $fotoData = mysqli_fetch_assoc($result);

    // Guardar la foto como un archivo temporal para usarla en el PDF
    $fotoTemporal = 'C:/xampp/htdocs/conecta_egresados/images/temp_foto.jpeg';

    // Reparar datos corruptos en la imagen si es necesario
    $fixedImage = @imagecreatefromstring($fotoData['contenido']);
    if ($fixedImage !== false) {
        ob_start();
        imagejpeg($fixedImage); // Reconvertir a formato JPEG limpio
        $cleanedImage = ob_get_clean();
        imagedestroy($fixedImage);
        file_put_contents($fotoTemporal, $cleanedImage);
        $foto = $fotoTemporal;
    } else {
        $foto = $fotoPredeterminada; // Usar la foto predeterminada si la imagen no es válida
    }
} else {
    $foto = $fotoPredeterminada; // Si no se encuentra foto en la base de datos, usar la predeterminada
}

// Verificar que el archivo base existe
if (!file_exists($templatePath)) {
    die('El archivo base no se encuentra.');
}

// Crear instancia de FPDI
use setasign\Fpdi\Fpdi;

$pdf = new Fpdi();

// Cargar el archivo base y obtener el número total de páginas
$pageCount = $pdf->setSourceFile($templatePath);

// Iterar sobre todas las páginas del archivo base
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $pdf->AddPage('P', 'A4'); // Crear página A4
    $templateId = $pdf->importPage($pageNo); // Importar la página actual
    $pdf->useTemplate($templateId, 0, 0, 210, 297); // Usar la plantilla completa en tamaño A4

    // Solo añadir texto dinámico en la primera página
    if ($pageNo === 1) {
        // Ajustar texto dinámico a la página A4
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetTextColor(0, 0, 0); // Color de texto negro

        $pdf->SetXY(25, 150); // Posición del texto para el nombre
        $pdf->Cell(190, 10, "$nombre $ap_p $ap_m", 0, 1, 'C'); // Nombre

        $pdf->SetXY(42, 170); // Posición del texto para la carrera
        $pdf->Cell(190, 10, "$carrera", 0, 1, 'C'); // Carrera

        $pdf->SetXY(10, 200); // Posición para el año de egreso
        $pdf->Cell(190, 10, "$ano_egre", 0, 1, 'C'); // Año de Egreso

        $pdf->SetXY(10, 250); // Posición del texto para el número de control
        $pdf->Cell(190, 10, "$num_con", 0, 1, 'C'); // Número de control

        // Imagen (cubre una sección específica en la primera página)
        if (file_exists($foto)) {
            $pdf->Image($foto, 150, 60, 40, 50); // Posición y tamaño de la imagen
        }
    }
}

// Eliminar archivo temporal si fue creado
if (isset($fotoTemporal) && file_exists($fotoTemporal)) {
    unlink($fotoTemporal);
}

// Generar el PDF y forzar la descarga
$pdf->Output('I', 'Credencial_Egresado.pdf');

// Cerrar conexión a la base de datos
$conn->close();
?>
