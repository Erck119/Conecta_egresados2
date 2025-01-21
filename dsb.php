<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="default.css" rel="stylesheet" type="text/css" media="all">
    <title>Panel de Usuario</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Configuración básica */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 70px; /* Espacio para el navbar fijo */
        }

        /* Navbar */
        .navbar {
            background-color: #800020;
        }

        .navbar-brand img {
            max-width: 50px;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            text-transform: uppercase;
        }

        .navbar-nav .nav-link:hover {
            color: #FFD700 !important;
        }

        /* Imagen del banner */
        .banner-img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        /* Lista del menú */
        #menu-wrapper {
            list-style: none;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0;
            padding: 10px 0;
            flex-wrap: wrap;
        }

        /* Elementos del menú */
        #menu-wrapper li {
            margin: 5px 10px;
        }

        /* Enlaces del menú */
        #menu-wrapper li a {
            color: #800020;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 25px;
            border: 2px solid #800020;
            border-radius: 20px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

        /* Efecto hover */
        #menu-wrapper li a:hover {
            background-color: #800020;
            color: #FFD700;
            border-color: #FFD700;
            transform: scale(1.1);
        }

        /* Botón "Salir" */
        #logout {
            display: block;
            background-color: #FF0000;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 20px auto;
            width: fit-content;
            text-align: center;
        }

        #logout:hover {
            background-color: #cc0000;
        }

        /* Imagen inferior */
        #wrapper img {
            max-width: 90%;
            height: auto;
            margin: 20px 0;
        }

        /* Media Queries para responsividad */
        @media (max-width: 768px) {
            /* Ajustar el tamaño de los enlaces del menú */
            #menu-wrapper li a {
                font-size: 14px;
                padding: 8px 15px;
            }

            #logout {
                font-size: 14px;
                padding: 8px 15px;
            }
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
                    <li class="nav-item">
                        <a class="nav-link" href="dsb.php"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Panel de Control</a>
                    </li>
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
                        <a class="nav-link" href="a.php" title="Mis datos"><i class="zmdi zmdi-account-circle"></i>Principal</a>
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
        <img src="images/membrete2024.1.png" alt="Banner" class="banner-img">
    </div>

    <!-- Contenido Principal -->
    <div id="wrapper">
       

  

        <!-- Menú adicional -->
        <div id="menu">
            <ul id="menu-wrapper">
                <li><a href="solicitud.php" title="Solicitudes Nuevas">Solicitudes Nuevas</a></li>
                <li><a href="docs.php" title="Documentos">Documentos</a></li>
                <li><a href="bus.php" title="Búsqueda de Egresados">Búsqueda de Egresados</a></li>
                <li><a href="listaegre.php" title="Administración">Administración</a></li>
                <li><a href="registroadmin.php" title="Agregar Administrador">Agregar Administrador</a></li>
            </ul>
        </div>

        <!-- Imagen inferior -->
        
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
<!-- Footer -->
<footer class="text-center py-3">
        <p>&copy; 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli</p>
    </footer>
</html>
