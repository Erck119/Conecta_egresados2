<!DOCTYPE html>
<html>
<head>
  <title>Formulario de Datos de Egresados</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    h1 {
      color: #333333;
    }

    form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #555555;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #cccccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>


<h2><br><br><br><br><br><br><br><br><br><br><center>

<form  method="POST">

<?php
// Recibimos los datos del formulario
$num_con = $_POST["num_con"];
$estado = $_POST["estado"];

// Realizamos la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "conecta_egresados");

// Verificamos si la conexión fue exitosa
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Creamos la sentencia SQL
$ssql = "UPDATE datos SET estado='$estado' WHERE num_con='$num_con'";

// Ejecutamos la sentencia de actualización
if ($conn->query($ssql) === TRUE) {
  echo '<p>Datos actualizados con éxito</p>';
} else {
  echo '<p>Hubo un error al actualizar los datos: ' . $conn->error . '</p>';
}

// Cerramos la conexión a la base de datos
$conn->close();
?>

<br>
    <center><a class="fcc-btn" href="solicitud.php">Regresar a Página Principal</a></center>