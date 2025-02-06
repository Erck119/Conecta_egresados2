<?php
require 'config.php'; // Asegúrate de que 'config.php' contiene la conexión a la base de datos
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['num_con'])) {
    header('Location: login.php');
    exit();
}

// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['num_con'];

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "conecta_egresados");

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener la carrera del usuario desde la base de datos
$queryCarrera = $conexion->prepare("SELECT carrera FROM usuarios WHERE num_con = ?");
$queryCarrera->bind_param("s", $nombreUsuario);
$queryCarrera->execute();
$resultCarrera = $queryCarrera->get_result();

if ($resultCarrera->num_rows > 0) {
    $carreraUsuario = $resultCarrera->fetch_assoc()['carrera'];
} else {
    $carreraUsuario = "No asignada"; // Si no se encuentra la carrera
}

// Variables para los filtros
$anio = $_GET['anio'] ?? '';
$sexo = $_GET['sexo'] ?? '';

// Crear consulta con filtros dinámicos
$query = "SELECT * FROM datos WHERE carrera = ?"; // Solo filtra por la carrera del usuario
if ($anio) {
    $query .= " AND ano_egre = ?";
}
if ($sexo) {
    $query .= " AND sexo = '$sexo'";
}

$stmt = $conexion->prepare($query);
if ($anio) {
    $stmt->bind_param("si", $carreraUsuario, $anio);
} else {
    $stmt->bind_param("s", $carreraUsuario);
}
$stmt->execute();
$result = $stmt->get_result();

// Contar registros
$totalRegistros = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Jefe de Carrera</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding-top: 70px;
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

        .table-container {
            padding: 20px;
        }

        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            margin-top: 150px;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/rino.png" alt="Logo"> JEFE(A) DE CARRERA
            </a>
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item">
                <a class="nav-link" href="login.php" title="Salir"><i class="zmdi zmdi-power"></i> Salir</a>
                </li>
            </ul>
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
                        <label for="carrera" class="form-label">Carrera</label>
                        <input type="text" id="carrera" name="carrera" class="form-control" value="<?= $carreraUsuario ?>" readonly>
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
                        <a href="exceladminc.php?carrera=<?= urlencode($carrera) ?>&anio=<?= urlencode($anio) ?>&sexo=<?= urlencode($sexo) ?>" 
                        class="btn btn-success ms-2">Excel</a>
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
