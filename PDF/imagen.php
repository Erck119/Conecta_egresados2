<?php
require 'config.php';
require 'tcpdf/tcpdf.php';

// Obtener la imagen desde la base de datos
$imageData = obtenerImagenDesdeBD(); // Debes implementar esta función según tu base de datos

// Crear archivo temporal para almacenar la imagen
$tempImagePath = 'temp_image.jpg';
file_put_contents($tempImagePath, $imageData);

// Crear instancia de la clase TCPDF
$pdf = new TCPDF();

// Agregar una nueva página al PDF
$pdf->AddPage();

// Agregar la imagen al documento PDF
$pdf->Image($tempImagePath, null, null, 180);

// Eliminar el archivo temporal
unlink($tempImagePath);

// Mostrar el PDF en el navegador
$pdf->Output('example.pdf', 'I');
?>
