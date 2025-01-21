<?php
require 'config.php';

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
  $rol = $_POST['rol'];
	$duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
	if (mysqli_num_rows($duplicate) > 0) {
		echo "<script>alert('El nombre de usuario o el correo electrónico ya esta registrado');</script>";
	} else {
		if ($password == $confirmpassword) {
			$query = "INSERT INTO tb_user VALUES ('', '$name', '$username', '$email', '$password','$rol')";
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
    input[type="password"],
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
</head>
<body>

<img src="images/fra.png" alt="" width="100%" height="2%">
	<h1><center>Registrate<center></h1>
<img src="images/fra.png" alt="" width="100%" height="2%">
	<form class="" action="" method="post" autocomplete="off">
		<label for="name"> Nombre </label>
		<input type="text" name="name" id="name" required value=""><br>
		<label for="username"> Número de Control </label>
		<input type="text" name="username" id="username" required value=""><br>
		<label for="email"> Correo </label>
		<input type="email" name="email" id="email" required value=""><br>
		<label for="password"> Contraseña </label>
		<input type="password" name="password" id="password" required value=""><br>
		<label for="confirmpassword"> Confirmar Contraseña </label>
		<input type="password" name="confirmpassword" id="confirmpassword" required value=""><br>
		
<label >Tipo de Usuario:</label>
<select id="rol" name="rol" required>
  <option value="">Usuario</option>
      <option value="egre">Egresado</option>
</select> 


      <center> <input  class="button" type="submit" name="submit" value="Enviar"> <center>
        
	<h2><center>¿Ya eres miembro? <center></h2>
      
 <a class="fcc-btn" href="login.php">iniciar secion</a>

	</form>
