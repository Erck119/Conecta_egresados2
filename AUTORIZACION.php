<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">

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


<h2><br><br><br><br><br><br><br><br><br><br><br><center><form enctype="multipart/form-data" action="guardar_archivo_foto.php" method="post">
    
<?php
require 'config.php';
session_start();

if (isset($_SESSION['nombre'])) {
    // Recupera el email o algún identificador único de la sesión
    $email = $_SESSION['nombre']; // Asegúrate de que esto esté definido al iniciar sesión

    // Realizamos la conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "conecta_egresados");

    // Verificamos si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para obtener los datos (num_con y estado) del usuario actual
    $ssql = "SELECT num_con, estado FROM datos WHERE nombre = '$email'";
    $result = $conn->query($ssql);

    // Verificamos si se encontró el registro
    if ($result->num_rows > 0) {
        // Obtenemos los datos y los asignamos a la sesión
        $row = $result->fetch_assoc();
        $_SESSION['num_con'] = $row['num_con'];
        $_SESSION['estado'] = $row['estado'];

        // Ahora trabajamos con los valores recuperados
        $num_con = $_SESSION['num_con'];
        $estado = $_SESSION['estado'];

        // Comparamos el estado
        if ($estado === "aceptar") {
            // Redireccionar a "EnviarPassword2.php" en la misma ventana
            echo '<script>window.location.href = "EnviarPassword2.php";</script>';
        } else {
            // Redireccionar a "EnviarPassword2.php" en la misma ventana
            echo '<script>window.location.href = "EnviarPassword2.php";</script>';
        }
    } else {
        echo "<script>
            alert('No se encontraron datos para este usuario.');
            window.location.href = 'login.php';
        </script>";
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
} else {
    echo "<script>
        alert('No se ha iniciado sesión');
        window.location.href = 'login.php';
    </script>";
}
?>