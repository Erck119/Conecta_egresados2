<?php
require 'config.php';
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Búsqueda de Egresados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 70px;
            background-color: #f2f2f2;
        }
        .banner-img {
            width: 100%;
            height: auto;
            margin-top: 56px;
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
        .btn-custom {
            background-color: #a62346;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #72122e;
        }
        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 214px;
        }
        #search {
            width: 70%;
            max-width: 600px;
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
                            Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownAdministracion">
                            <li><a class="dropdown-item" href="solicitud.php">Solicitudes Nuevas</a></li>
                            <li><a class="dropdown-item" href="docs.php">Documentos</a></li>
                            <li><a class="dropdown-item" href="bus.php">Búsqueda de Egresado</a></li>
                            <li><a class="dropdown-item" href="jefe.php"><i class="zmdi zmdi-book"></i> Listado de Egresados</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownUsuarios">
                            <li><a class="dropdown-item" href="listaegre.php">Administración de usuarios</a></li>
                            <li><a class="dropdown-item" href="registroadmin.php">Agregar Administrador</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="a.php" title="Mis datos">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" title="Salir">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Banner -->
    <div class="container-fluid">
        <img src="images/Imagen1.png" alt="Banner" class="banner-img">
    </div>

    <!-- Formulario de búsqueda -->
    <div class="container mt-5">
        <h1 class="text-center">Búsqueda de Egresados</h1>
        <form method="get" class="text-center mb-4">
            <input type="text" name="search" id="search" class="form-control d-inline-block" placeholder="Buscar por número de control">
            <button type="submit" class="btn btn-custom ms-2">Buscar</button>
        </form>
    </div>

    <!-- Modal de resultados -->
    <div class="modal fade" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultsModalLabel">Resultados de la Búsqueda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    require 'config.php';
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql = "SELECT * FROM datos WHERE num_con LIKE '%$search%' ORDER BY fecha DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<ul class='list-group'>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<li class='list-group-item'>";
                                echo "<strong>Nombre:</strong> " . $row["nombre"] . "<br>";
                                echo "<strong>Apellido Paterno:</strong> " . $row["ap_p"] . "<br>";
                                echo "<strong>Apellido Materno:</strong> " . $row["ap_m"] . "<br>";
                                echo "<strong>Número de Celular:</strong> " . $row["tel_1"] . "<br>";
                                echo "<strong>Correo Electrónico:</strong> " . $row["email_1"] . "<br>";
                                echo "<strong>Carrera:</strong> " . $row["carrera"] . "<br>";
                                echo "<strong>Año de Egreso:</strong> " . $row["ano_egre"] . "<br>";
                                echo "<strong>Fecha de Registro:</strong> " . $row["fecha"] . "<br>";
                                echo "</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<p class='text-center'>No se encontraron resultados para \"$search\"</p>";
                        }
                    } else {
                        echo "<p class='text-center'>Por favor ingrese un número de control para buscar.</p>";
                    }
                    $conn->close();
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar el modal solo si se realizó una búsqueda
        <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
            const resultsModal = new bootstrap.Modal(document.getElementById('resultsModal'));
            resultsModal.show();

            // Eliminar el parámetro 'search' de la URL para evitar que el modal se abra al recargar
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            window.history.replaceState({}, document.title, url.toString());
        <?php endif; ?>
    </script>
</body>
</html>