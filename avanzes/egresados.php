<?php
require 'config.php';
session_start();
if (isset($_SESSION['nombre'])) {
       $nombre = $_SESSION['nombre']; 
        echo '<script>';
    echo 'var nombre = "' . $nombre . '";';
    echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Admin</title>
<center><img src="images/membrete horizontal 2023_Mesa de trabajo 1.png" alt="" width="90%" height="20%">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<br>
</head>
<body>
</center>

	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
	<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
	<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
		<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title"><h2>
				EGRESADOS <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					
       <img src="images/rino.png" alt="" width="25%" height="55%">

					<figcaption class="text-center text-titles"> </figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
					<h2><a href="egresados.php" title="Mis datos">
							<i class="zmdi zmdi-account-circle"></i>
						</a>
					</li>
					<li>
						
                    <h2><a href="login.php" title="Salir">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>

				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Egresados <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
					
						<li>
							<a href="registro.php"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Formulario</a>
						</li>
						
						<li>
<a href="subdocs.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Documentos</a>

						</li>
						<li>
<a href="descargar.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Descarga de Credencial</a>

						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuario <i class="zmdi zmdi-caret-down pull-right"></i>
						</a>
					<ul class="list-unstyled full-box">
					
						<li>
							<a href="perfil.php"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> perfil</a>
						</li>
					
					<ul class="list-unstyled full-box">
											
						<li>
							
						</li>
					
					</ul>
				</li>
				<li>
				
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
						<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>

				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid"><br>
			<div class="page-header"><br><br><br>
			  <h2 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuario <small>EGRESADOS</small></h2>
			</div>
		<p class="lead">Tecnológico de Estudios Superiores de Cuautitlán Izcalli</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
			  		


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
	<title>a</title>
</head>
<body>


		<!-- Panel nuevo administrador -->
		<div class="container-fluid">
			<div class="panel panel-info">
				<div class="panel-heading">
					</div>
				<div class="panel-body">
					<form>
				    	<fieldset>
<legend><h2> <i class="zmdi zmdi-account-box"></i> &nbsp; Extensión y Seguimiento de Egresados</legend>
		<div class="container-fluid">
		<div class="row">
		<div class="col-xs-12">
		<div class="form-group label-floating">	
    	</div>
		</div>
		
    <form  method="POST">
    <legend><h2></i> &nbsp; Credencial Virtual</legend><br>
    <h1> <label for="nombre">La credencial virtual institucional te identifica como egresado del Tecnológico de Estudios Superiores de Cuautitlán Izcalli, haciendo fácil el acceso a las unidades Académicas y Empresariales. </label><br>
    
	
    <legend><h2></i> &nbsp;  Requisitos</legend><br>
    
    <h2> <label for="nombre">1. Ser egresado del tecnológico de estudios superiores de Cuautitlán Izcalli</label>
   
    <h2> <label for="nombre">  2. Contar con fotografía de buena calidad, a color con fondo claro, de busto (donde se puedan observar hombros, rostro de frente y despejado, sin anteojos o flecos), que no se encuentren obscuras.</label>
   
    <h2> <label for="nombre">3. Contar con número de control.</label>
    
    <h2> <label for="nombre">4. Contar con carta de termino de residencias e inglés (según sea el nivel que se encuentre cursando o en su defecto su constancia de inglés acreditada). 
 </label><br>
    


  <center>  <img src="images/rino_plasta_negro.png" alt="" width="25%" height="55%">





 </label>
    


	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>