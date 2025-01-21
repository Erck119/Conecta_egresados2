<?php
require 'config.php';
session_start();
if (isset($_SESSION['nombre'])) {
       $nombre = $_SESSION['nombre']; 
        $ap_p = $_SESSION['ap_p'];
         $ap_m = $_SESSION['ap_m'];
         $carrera = $_SESSION['carrera'];
         $ano_egre = $_SESSION['ano_egre'];
         $num_con = $_SESSION['num_con'];
        

  
 echo '<script>';
    echo 'var num_con = "' . $num_con . '";';
    echo 'var num_con = "' . $num_con . '";';
    echo '</script>';
    echo '<script>';
    echo 'var nombre = "' . $nombre . '";';
    echo 'var ap_p = "' . $ap_p . '";';
    echo '</script>';
     echo '<script>';
    echo 'var carrera = "' . $carrera . '";';
    echo '</script>';
    echo '<script>';
    echo 'var ano_egre = "' . $ano_egre . '";';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Perfil del egresado</title>
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

 <center><img src="images/membrete horizontal 2023_Mesa de trabajo 1.png" alt="" width="90%" height="20%"></center>

  
   <h1><center>perfil<center></h1>

  

  <form  method="POST">
    <label for="nombre">Tu nombre es:</label>
   <input type="text" value="<?php echo $nombre; ?>"readonly>
   
    <label for="ap_p">Apellido Paterno</label>
    <input type="text" value="<?php echo $ap_p;?>">
    <label for="ap_m">Apellido Materno</label>
    <input type="text" value="<?php echo $ap_m;?>">
    <label for="carrera"> carrera</label>
    <input type="text" value="<?php echo $carrera;?>">
    <label for="carrera">Año de egreso</label>
    <input type="text" value="<?php echo $ano_egre;?>">
    <label for="carrera">numero de control</label>
    <input type="text" value="<?php echo $num_con;?>">

        <a href="egresados.php" target="_blank">regresar</a>


  

 </form>
  </form>

</body>
</html>
