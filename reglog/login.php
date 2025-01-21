<?php
session_start();
require 'config.php';

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'"); // Verifica el nombre de usuario o el correo electrónico
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row["password"]) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row["id"];
            $rol = $row["rol"]; // Obtiene el rol del usuario

            if ($rol === 'admin') {
                header("Location: a.php"); // Redirecciona a la página específica para el rol 'admin'
                exit(); // Finaliza el script después de redirigir
            } else {
                header("Location: index.php"); // Redirecciona a otra página para otros roles
                exit(); // Finaliza el script después de redirigir
            }
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no registrado');</script>";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INICIO DE SESION</title>



<body background="rino_plasta_negro.jpg">




    <style type="text/css">
    body {
        background-color: #ECEFF1;
    }
    </style>
</head>
<body>
 <img src="images/fra.png" alt="" width="100%" height="80%">
  <center><img src="images/logo_TESCI_2020.png" alt="" width="60%" height="60%">
<hr>

  </center>
    <h1><center>CONECTA-EGRESADOS</center></h1>
    <h2><center>INICIO DE SESIÓN</center></h2>
    <hr>
   








    <center>

        <h3>¿Eres nuevo?</h3> 
        <a href="registration.php">Registrarse</a><br><br>
        <form class="" action="" method="post" autocomplete="off">
            <label for="usernameemail">Correo Electrónico</label><br>
            <input type="text" name="usernameemail" id="usernameemail" required value=""> <br><br>
            <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password" required value=""><br><br>
            <button type="submit" name="submit">Ingresar</button><br><br>
            <a href="seteolvidolacontraseña.php" title="">¿Se te olvidó la Contraseña?</a><br><br>
            <a href="https://www.mozilla.org/es-ES/" title="">Ayuda</a><br><br>
           
        </form>
    </center>
</body>
</html>





