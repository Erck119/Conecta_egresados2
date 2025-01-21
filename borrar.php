<?php
// Recibimos los datos del formulario
$num_con= $_POST["num_con"];

// Realizamos la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "conecta_egresados");

// Verificamos si la conexión fue exitosa
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Creamos la sentencia SQL
$ssql = "DELETE FROM usuarios WHERE num_con='$num_con'";

// Ejecutamos la sentencia de borrado
if ($conn->query($ssql) === TRUE) {
  echo '<p>Contacto borrado con éxito</p>';
} else {
  echo '<p>Hubo un error al borrar el contacto: ' . $conn->error . '</p>';
}

// Cerramos la conexión a la base de datos
$conn->close();
?>