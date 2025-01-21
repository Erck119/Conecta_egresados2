<?php
require 'config.php';
session_start();
if (isset($_SESSION['nombre'])) {

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
	<style>
		
            body {
            font-family: Arial, sans-serif;
			padding-top: 70px; /* Ajustar para el navbar fijo */
        }

        .banner-img {
            width: 100%;
            height: auto;
            margin-top: 56px; /* Espacio para evitar que el navbar cubra la imagen */
        }
        .navbar {
            background-color: #a62346 !important;
        }

        .navbar-brand img {
            max-width: 50px;
            margin-right: 10px;
        }

        .navbar .nav-link {
            color: #ffffff !important;
        }

        .navbar .dropdown-menu {
            background-color: #a62346;
        }

        .navbar .dropdown-item {
            color: #ffffff !important;
        }

        .navbar .dropdown-item:hover {
            background-color: #72122e;
        }

        .content {
            padding: 20px;
        }
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/rino.png" alt="Logo" style="max-width: 50px;"> ADMINISTRADOR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownAdministracion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="zmdi zmdi-case"></i> Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownAdministracion">
                            <li><a class="dropdown-item" href="solicitud.php"><i class="zmdi zmdi-balance"></i> Solicitudes Nuevas</a></li>
                            <li><a class="dropdown-item" href="docs.php"><i class="zmdi zmdi-labels"></i> Documentos</a></li>
                            <li><a class="dropdown-item" href="bus.php"><i class="zmdi zmdi-book"></i> Búsqueda de Egresado</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="zmdi zmdi-account-add"></i> Usuarios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownUsuarios">
                            <li><a class="dropdown-item" href="listaegre.php"><i class="zmdi zmdi-male-female"></i> Administración de usuarios</a></li>
                            <li><a class="dropdown-item" href="registroadmin.php"><i class="zmdi zmdi-male-female"></i> Agregar Administrador</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes.php"><i class="zmdi zmdi-chart"></i> Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="configuracion.php"><i class="zmdi zmdi-settings"></i> Configuración</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="a.php" title="Mis datos"><i class="zmdi zmdi-account-circle"></i>Principal </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" title="Salir"><i class="zmdi zmdi-power"></i> Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="container-fluid">
        <img src="images/Imagen1.png" alt="Banner" class="banner-img">
    </div>

    <!-- Contenido Principal -->
    <div class="container my-5">
        <h2 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> ADMINISTRADOR </h2>
		<legend>Objetivo</legend>
		<label for="nombre">Realizar los programas de vinculación con los sectores de la sociedad para garantizar el cumplimiento de los programas de residencias profesionales y consolidar el desarrollo tecnológico de las y los estudiantes, egresadas y egresados, mediante la recomendación de las y los alumnos destacados ante instituciones de los sectores, públicos, social o privado relacionadas con el mercado laboral.</label>
    </div>
	<div class="text-center">
            <img src="images/rino_plasta_negro.png" alt="Logo" width="25%">
        </div>
    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>