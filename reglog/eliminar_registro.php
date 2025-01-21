<?php
require 'config.php';

// Obtener el ID del registro a eliminar desde la petición AJAX
$registro_id = $_POST['registro_id'];

// Realizar la consulta para eliminar el registro
$sql = "DELETE FROM datos WHERE id = $registro_id";
$resultado = mysqli_query($conn, $sql);

// Verificar si la eliminación fue exitosa
if ($resultado) {
    echo "Registro eliminado correctamente.";
} else {
    echo "Error al eliminar el registro.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
