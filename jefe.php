<?php
require 'config.php'; // Asegúrate de que 'config.php' contiene la conexión a la base de datos
session_start();

if (!isset($_SESSION['num_con'])) {
    header('Location: login.php');
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "conecta_egresados");

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Variables para los filtros
$carrera = $_GET['carrera'] ?? '';
$anio = $_GET['anio'] ?? '';
$sexo = $_GET['sexo'] ?? '';

// Crear consulta con filtros dinámicos
$query = "SELECT * FROM datos WHERE 1";
if ($carrera) {
    $query .= " AND carrera = '$carrera'";
}
if ($anio) {
    $query .= " AND ano_egre = '$anio'";
}
if ($sexo) {
    $query .= " AND sexo = '$sexo'";
}

// Ejecutar consulta
$result = $conexion->query($query);

// Contar registros
$totalRegistros = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Jefe de Carrera</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding-top: 70px;
        }
        .banner-img { width: 100%; height: auto; margin-top: 56px; }
        .navbar { background-color: #a62346 !important; }
        .navbar-brand img { max-width: 50px; margin-right: 10px; }
        .navbar .nav-link { color: #ffffff !important; }
        .navbar .dropdown-menu { background-color: #a62346; }
        .navbar .dropdown-item { color: #ffffff !important; }
        .navbar .dropdown-item:hover { background-color: #72122e; }
        .table-container { padding: 20px; }
        footer { background-color: #333333; color: white; text-align: center; padding: 10px 0; position: relative; margin-top: 150px; width: 100%; }
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
                            <li><a class="dropdown-item" href="jefe.php"><i class="zmdi zmdi-book"></i> Listado de Egresados</a></li>
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

    <!-- Contenedor de la tabla y filtros -->
    <div class="container mt-5">
        <h1 class="text-center">Gestión de Egresados</h1>
        <div class="table-container">
            <!-- Formulario de filtros -->
            <form method="get" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="carrera" class="form-label">Seleccione una carrera</label>
                        <select name="carrera" id="carrera" class="form-select">
                            <option value="" disabled selected>Todas</option>
                            <option value="Ingenieria en Electrónica">Ing. Electrónica</option>
                            <option value="Ingenieria en Sistemas de Computo">Ing. en Sistemas Computacionales</option>
                            <option value="Ingenieria en Gestión Empresarial">Ing. en Gestión Empresarial</option>
                            <option value="Ingeniería en TICS">Ingeniería en Tecnologías de la Información y Comunicaciones</option>
                            <option value="Contador Público">Contador Público</option>
                            <option value="Ingeniería en Industrial">Ing. Industrial</option>
                            <option value="Ingeniería en Logística">Ing. en Logística</option>
                            <option value="Ingeniería en Administración">Ing. en Administración</option>
                            <option value="Ingeniería en Mecatrónica">Ing. Mecatrónica</option>
                            <option value="Ingeniería en Química">Ing. Química</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="anio" class="form-label">Seleccione un año</label>
                        <select name="anio" id="anio" class="form-select">
                            <option value="">Todos</option>
                            <?php for ($i = 1990; $i <= 2024; $i++): ?>
                                <option value="<?= $i ?>" <?= $anio == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sexo" class="form-label">Seleccione el género</label>
                        <select name="sexo" id="sexo" class="form-select">
                            <option value="">Todos</option>
                            <option value="Masculino" <?= $sexo == "Masculino" ? 'selected' : '' ?>>Masculino</option>
                            <option value="Femenino" <?= $sexo == "Femenino" ? 'selected' : '' ?>>Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="./excelbus.php" class="btn btn-success ms-2">Excel</a>
                    </div>
                </div>
            </form>

            <!-- Mostrar total de registros -->
            <p class="text-center">Total de registros encontrados: <strong><?= $totalRegistros ?></strong></p>

            <!-- Tabla de resultados -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Núm. Control</th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Carrera</th>
                        <th>Año de Egreso</th>
                        <th>Sexo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($totalRegistros > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['num_con'] ?></td>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['ap_p'] ?></td>
                                <td><?= $row['ap_m'] ?></td>
                                <td><?= $row['carrera'] ?></td>
                                <td><?= $row['ano_egre'] ?></td>
                                <td><?= $row['sexo'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron registros.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>©️ 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>