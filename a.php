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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <!-- Estilos personalizados -->
	<style>
		
            body {
            font-family: Arial, sans-serif;
			padding-top: 70px; /* Ajustar para el navbar fijo */
            background-color: #f2f2f2;
      		margin: 0;
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
        .content h2 {
            color: #333333;
        }
        .custom-container {
            border: 1px solid rgba(0, 0, 0, 0.2); /* Borde más transparente */
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(249, 249, 249, 0.95); /* Fondo más claro */
            height: 100%;
            box-shadow: 2px 2px 2px 2px rgba(0.2, 0, 0, 0.2);
            bottom: 10px;
        }

        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            margin-top: 30px;
            width: 100%;
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
                        <i class="zmdi zmdi-settings"></i> Administración
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownAdministracion">
                        <li><a class="dropdown-item" href="solicitud.php"><i class="zmdi zmdi-email"></i> Solicitudes Nuevas</a></li>
                        <li><a class="dropdown-item" href="docs.php"><i class="zmdi zmdi-file-text"></i> Documentos</a></li>
                        <li><a class="dropdown-item" href="bus.php"><i class="zmdi zmdi-search"></i> Búsqueda de Egresado</a></li>
                        <li><a class="dropdown-item" href="jefe.php"><i class="zmdi zmdi-collection-text"></i> Listado de Egresados</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-accounts"></i> Usuarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownUsuarios">
                        <li><a class="dropdown-item" href="listaegre.php"><i class="zmdi zmdi-account-box-mail"></i> Administración de Usuarios</a></li>
                        <li><a class="dropdown-item" href="registroadmin.php"><i class="zmdi zmdi-account-add"></i> Agregar Administrador</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="a.php" title="Mis datos"><i class="zmdi zmdi-home"></i> Principal</a>
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

    <div class="container-fluid">
    <div class="row">
        <!-- Contenedor izquierdo -->
        <div class="col-md-6">
            <div class="custom-container">
                <h2 class="text-center">ADMINISTRADOR</h2>
                <h4>Objetivo</h4>
                <p>
                Permitir la generación de la credencial digital para los egresados que la soliciten, teniendo el poder para visualizar los documentos solicitados por la institución para dicho proceso y de igual forma tener un control digital de los egresados del Tecnológico de Estudios Superiores de Cuautitlán Izcalli, poder realizar el registro para los jefes de carrera de la institución y ampliar el número de administradores en la plataforma.
                </p>
                <div class="text-center">
                    <img src="images/rino_plasta_negro.png" alt="Logo" width="25%">
                </div>
            </div>
        </div>

        <!-- Contenedor derecho -->
        <div class="col-md-6">
            <div class="custom-container">
                <h2 class="text-center">JEFE DE CARRERA</h2>
                <h4>Objetivo</h4>
                <p>
                    Poder visualizar los datos de los egresados registrados correspondientes a la carrera del jefe en sesión paara que se pueda tener un control si es que se requiere.
                </p>
                
                <div class="text-center">
                    <img src="images/rino_plasta_negro.png" alt="Logo" width="25%">
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Footer -->
<footer>
    <p>©️ 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>