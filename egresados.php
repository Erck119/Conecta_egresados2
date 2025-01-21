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
    <title>Interfaz Egresado</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel ="stylesheet" href=".
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
            body {
            font-family: Arial, sans-serif;
        }

        .banner-img {
            width: 100%;
            height: auto;
            margin-top: 70px; /* Espacio para evitar que el navbar cubra la imagen */
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

        .content h2 {
            color: #333333;
        }

        .container-fluid {
             margin-right:20px;
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
            margin-top:20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/rino.png" alt="Logo"> EGRESADO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownEgresados" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-case"></i> Documentación
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownEgresados">
                        <li><a class="dropdown-item" href="registro.php"><i class="zmdi zmdi-labels"></i> Formulario</a></li>
                        <li><a class="dropdown-item" href="subdocs.php"><i class="zmdi zmdi-book"></i> Documentos</a></li>
                        <li><a class="dropdown-item" href="descargar.php"><i class="zmdi zmdi-download"></i> Descargar Credencial</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-account-add"></i> Usuario
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownUsuario">
                        <li><a class="dropdown-item" href="perfil.php"><i class="zmdi zmdi-labels"></i> Perfil</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Pestañas alineadas a la derecha -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="egresados.php">
                        <i class="zmdi zmdi-home"></i> Principal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" title="Salir">
                        <i class="zmdi zmdi-power"></i> Salir
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



    <!-- Imagen de banner -->
    <div>
        <img src="images/imagen1.png" alt="Banner" class="banner-img">
    </div>

    <div class="container-fluid">
      <div class="row">
        <!-- Contenedor izquierdo -->
        <div class="col-md-6">
            <div class="custom-container">
                <h2 class="text-center">Extensión y Seguimiento de Egresados</h2>
                <h4>Credencial Virtual</h4>
                <p>
                    La credencial virtual institucional te identifica como egresado del Tecnológico de Estudios Superiores de Cuautitlán Izcalli, facilitando el acceso a las unidades Académicas y Empresariales.
                </p>
                <h4>Requisitos</h4>
                <ul>
                    <li>Ser egresado del Tecnológico de Estudios Superiores de Cuautitlán Izcalli.</li>
                    <li>Contar con una fotografía de buena calidad, a color, con fondo claro y de busto.</li>
                    <li>Contar con número de control.</li>
                    <li>Contar con carta de término de residencias e inglés (o constancia acreditada).</li>
                </ul>
                <div class="text-center">
                    <img src="images/rino_plasta_negro.png" alt="Logo" width="25%">
                </div>
            </div>
        </div>

        <!-- Contenedor derecho -->
        <div class="col-md-6">
    <div class="custom-container">
        <h4 class="text-center">VISTA PREVIA DE CREDENCIAL</h4>
        
        <div class="text-center d-flex justify-content-center align-items-center gap-6">
            <!-- Ajuste de las imágenes -->
            <img src="images/1.jpg" alt="Imagen adicional" class="img-fluid" style="max-width: 40%; margin-right: 20px; border: 2px solid black; border-radius: 10px;">
            <img src="images/2.jpg" alt="Imagen adicional" class="img-fluid" style="max-width: 40%; margin-left: 20px;  border: 2px solid black; border-radius: 10px;">
        </div>
    </div>
</div>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>© 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
