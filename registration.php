<?php
require 'config.php';

if (isset($_POST['submit'])) {
  $nombre = $_POST['nombre'];
  $num_con = $_POST['num_con'];
  $email = $_POST['email'];
  $contraseña = $_POST['contraseña'];
  $confirmcontraseña = $_POST['confirmcontraseña'];
  $rol = $_POST['rol'];
  $duplicate = mysqli_query($conn, "SELECT * FROM usuarios WHERE num_con = '$num_con' OR email = '$email'");
  if (mysqli_num_rows($duplicate) > 0) {
    echo "<script>alert('El nombre de usuario o el correo electrónico ya esta registrado');</script>";
  } else {
    if ($contraseña == $confirmcontraseña) {
      $query = "INSERT INTO usuarios VALUES ('$num_con', '$nombre', '$contraseña', '$rol','$email')";
      mysqli_query($conn, $query);
      echo "<script>alert('Registro exitoso');</script>";
    } else {
      echo "<script>alert('Las contraseñas no coinciden');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  

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
    input[type="contraseña"],
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


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta nombre="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>
</head>
<body>
<center><img src="images/membrete horizontal 2023_Mesa de trabajo 1.png" alt="" width="90%" height="20%"></center>
  <h1><center>Regístrate<center></h1>

  <form class="" action="" method="post" autocomplete="off">
    <label for="nombre"> Nombre(s) </label>
    <input type="text" name="nombre" id="nombre" required value=""><br>
    <label for="num_con"> Número de Control </label>
    <input type="text" name="num_con" id="num_con" required value=""><br>
    <label for="email"> Correo </label>
    <input type="email" name="email" id="email" required value=""><br>
    <label for="contraseña"> Contraseña </label>
    <input type="contraseña" name="contraseña" id="contraseña" required value=""><br>
    <label for="confirmcontraseña"> Confirmar Contraseña </label>
    <input type="contraseña" name="confirmcontraseña" id="confirmcontraseña" required value=""><br>
    
<label >Usuario</label>
<select id="rol" name="rol" required>
  <option value=""></option>
      <option value="egre">Egresado</option>
</select> 


      <center> <input  class="button" type="submit" name="submit" value="Enviar"> <center>
        
  <h2><center>¿Ya eres miembro? <center></h2>
      
 <a class="fcc-btn" href="login.php">Iniciar Sesión</a>

  </form>