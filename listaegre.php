<?php
require 'config.php';
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
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

        .navbar .dropdown-menu {
            background-color: #a62346;
        }

        .navbar .dropdown-item {
            color: #ffffff !important;
        }

        .navbar .dropdown-item:hover {
            background-color: #72122e;
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

    <!-- Contenido -->
    <div class="container table-container">
        <h1 class="text-center">Usuarios Registrados</h1>

        <!-- Buscador y filtro -->
        <form method="get" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o número de control" value="<?= $_GET['search'] ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <select name="filter" class="form-select">
                        <option value="">Todos</option>
                        <option value="Egresado" <?= (isset($_GET['filter']) && $_GET['filter'] === 'Egresado') ? 'selected' : '' ?>>Egresado</option>
                        <option value="Administrador" <?= (isset($_GET['filter']) && $_GET['filter'] === 'Administrador') ? 'selected' : '' ?>>Administrador</option>
                        <option value="Jefe de Carrera" <?= (isset($_GET['filter']) && $_GET['filter'] === 'Jefe de Carrera') ? 'selected' : '' ?>>Jefe de Carrera</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Tabla de usuarios -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Número de Control</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = $_GET['search'] ?? '';
                $filter = $_GET['filter'] ?? '';

                $sql = "SELECT * FROM usuarios WHERE (nombre LIKE '%$search%' OR num_con LIKE '%$search%' OR email LIKE '%$search%')";
                if ($filter) {
                    $sql .= " AND rol = '$filter'";
                }

                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['num_con']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['rol']}</td>
                                <td>
                                    <button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#modalUser{$row['num_con']}'>Ver Más</button>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['num_con']}'>Borrar</button>
                                </td>
                              </tr>";

                        // Modal para ver más detalles
                        echo "<div class='modal fade' id='modalUser{$row['num_con']}' tabindex='-1' aria-labelledby='modalUserLabel{$row['num_con']}' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='modalUserLabel{$row['num_con']}'>Detalles del Usuario</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <p><strong>Número de Control:</strong> {$row['num_con']}</p>
                                            <p><strong>Nombre:</strong> {$row['nombre']}</p>
                                            <p><strong>Apellido Paterno:</strong> {$row['ap_p']}</p>
                                            <p><strong>Apellido Materno:</strong> {$row['ap_m']}</p>
                                            <p><strong>Email:</strong> {$row['email']}</p>
                                            <p><strong>Rol:</strong> {$row['rol']}</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                              </div>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No se encontraron resultados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="text-center">
    <p>©️ 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                    // Crear el formulario
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'borrar.php';

                    // Crear el campo oculto para el num_con
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'num_con';
                    input.value = button.dataset.id;

                    // Agregar el campo al formulario
                    form.appendChild(input);

                    // Agregar el formulario al body
                    document.body.appendChild(form);

                    // Enviar el formulario
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
