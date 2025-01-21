<?php
require 'config.php';
session_start();
// Verifica si el usuario está logueado
if (isset($_SESSION['num_con'])) {
  $num_con = $_SESSION['num_con'];
} else {
  header("Location: login.php");
  exit();
}
?>
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
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #555555;
      text-align: left;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #cccccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
      font-size: 16px;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      padding: 12px 20px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .boton-contenedor {
      display: flex;
      justify-content: center;
      gap: 10px; /* Espacio entre los botones */
    }

    .boton, .boton-volver {
      padding: 10px 20px;
      font-size: 16px;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s;
      display: inline-block; /* Asegura que los botones se comporten correctamente */
    }

    .boton {
      background-color: #4caf50;
    }

    .boton-volver {
      background-color: #808080;
    }

    .boton-volver:hover {
      background-color: #6e6e6e;
    }

    /* Media Queries para Responsividad */
    @media (max-width: 768px) {
      body {
        padding: 15px;
      }

      form {
        padding: 15px;
      }

      input[type="text"],
      input[type="file"] {
        font-size: 14px;
        padding: 10px;
      }

      input[type="submit"] {
        font-size: 14px;
        padding: 10px 18px;
      }

      .boton, .boton-volver {
        font-size: 14px;
        padding: 10px 18px;
      }
    }

    @media (max-width: 480px) {
      form {
        padding: 10px;
      }

      input[type="text"],
      input[type="file"] {
        font-size: 13px;
        padding: 8px;
      }

      input[type="submit"] {
        font-size: 13px;
        padding: 8px 16px;
      }

      .boton, .boton-volver {
        font-size: 13px;
        padding: 8px 16px;
      }
    }
  
  </style>
</head>
<body>

<img src="images/imagen1.png" alt="" width="100%" height="15%">

<h1>ESCOGE LA FOTO PARA TU CREDENCIAL </h1>




<center><form enctype="multipart/form-data" action="guardarfoto.php" method="post">
    <input type="file" name="archivito"><br>
<br>
<label for="num_con" class="form-label">Número de Control</label>
<input type="text" id="num_con" name="num_con" class="form-control" value="<?php echo $num_con; ?>" readonly>

<div class="boton-contenedor">
    <input type="submit" value="Enviar archivo">
<br><br>
<a class="boton-volver" href="descargar.php">Regresar a la Página </a>
    <br>
    </div>
</form>



