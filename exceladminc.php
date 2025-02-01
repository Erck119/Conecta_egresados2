<?php
require 'config.php';
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "conecta_egresados");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=egresados_filtrados.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Obtener filtros aplicados
$carrera = $_GET['carrera'] ?? '';
$anio = $_GET['anio'] ?? '';
$sexo = $_GET['sexo'] ?? '';

// Crear la consulta con los filtros
$query = "SELECT * FROM datos WHERE 1";
if ($carrera) {
    $query .= " AND carrera = '" . $conexion->real_escape_string($carrera) . "'";
}
if ($anio) {
    $query .= " AND ano_egre = '" . $conexion->real_escape_string($anio) . "'";
}
if ($sexo) {
    $query .= " AND sexo = '" . $conexion->real_escape_string($sexo) . "'";
}

// Ejecutar la consulta
$result = $conexion->query($query);

// Imprimir los encabezados de la tabla en Excel
echo "Núm. Control\tNombre\tPaterno\tMaterno\tCarrera\tAño de Egreso\tSexo\n";

// Imprimir los datos de los egresados
while ($row = $result->fetch_assoc()) {
    echo "{$row['num_con']}\t{$row['nombre']}\t{$row['ap_p']}\t{$row['ap_m']}\t{$row['carrera']}\t{$row['ano_egre']}\t{$row['sexo']}\n";
}

// Cerrar la conexión
$conexion->close();
?>