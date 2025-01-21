<?php
require("config.php");

$id = $_GET['id'];

$qry = "SELECT tipo, contenido FROM documentos  WHERE id=$id";
$res = mysqli_query($conn, $qry);

if ($res) {
    $fila = mysqli_fetch_assoc($res);
    $tipo = $fila['tipo'];
    $contenido = $fila['contenido'];

    header("Content-type: $tipo");
    echo $contenido;
} else {
    echo "Error al obtener el archivo.";
}
?>
