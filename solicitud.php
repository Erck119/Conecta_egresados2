<?php
require 'config.php';
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['num_con'])) {
    $num_con = mysqli_real_escape_string($conn, $_POST['num_con']);
    $estado = ($_POST['action'] === 'autorizar') ? 'aceptar' : 'rechazar';

    $queryUpdate = "UPDATE datos SET estado = '$estado' WHERE num_con = '$num_con'";

    if (mysqli_query($conn, $queryUpdate)) {
        echo "
        <div id='successMessage' style='
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #dc3545; /* Rojo */
            color: #ffffff; /* Blanco */
            padding: 20px 30px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 1050;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        '>
            Estado actualizado correctamente a \"$estado\".
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('successMessage').remove();
                window.location.href = 'solicitud.php';
            }, 5000);
        </script>";
    } else {
        echo "
        <div id='errorMessage' style='
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #dc3545; /* Rojo */
            color: #ffffff; /* Blanco */
            padding: 20px 30px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 1050;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        '>
            Error al actualizar el estado. Intenta nuevamente.
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('errorMessage').remove();
            }, 5000);
        </script>";
    }
    
}

// Inicializamos la conexión desde config.php
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesamos la búsqueda
$search = $_GET['search'] ?? '';
$query = "SELECT num_con, nombre, ap_p, ap_m, tel_1, carrera, ano_egre,estado 
          FROM datos 
          WHERE num_con LIKE ?";
$stmt = $conn->prepare($query);
$searchParam = "%$search%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Solicitudes</title>
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
        table {
            width: 100%;
            margin-top: 20px;
            background-color: white;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .btn-custom {
            background-color: #a62346;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #72122e;
        }
        .btn-maroon {
            background-color: #800000; /* Color guinda */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
          }

        .btn-maroon:hover {
            background-color: #660000; /* Color más oscuro al pasar el mouse */
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

    <div class="container mt-5">
        <form method="get" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por número de control" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-custom">Buscar</button>
            <a href="./excelsolicitud.php" class="btn btn-success ms-2">Excel</a>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Número de control</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['num_con']) ?></td>
                            <td><?= htmlspecialchars($row['estado']) ?></td>
                            <td>
                                <form method="POST" action="" style="display:inline-block;">
                                    <input type="hidden" name="num_con" value="<?= htmlspecialchars($row['num_con']) ?>">
                                    <button type="submit" name="action" value="autorizar" class="btn btn-maroon">Autorizar</button>
                                    <button type="submit" name="action" value="rechazar" class="btn btn-maroon">Rechazar</button>
                                </form>
                                <button class="btn btn-info" onclick="showDetails('<?= htmlspecialchars(json_encode($row)) ?>')">Ver datos</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Detalles del Egresado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                    <p><strong>Apellido Paterno:</strong> <span id="modalApellidoP"></span></p>
                    <p><strong>Apellido Materno:</strong> <span id="modalApellidoM"></span></p>
                    <p><strong>Teléfono:</strong> <span id="modalTelefono"></span></p>
                    <p><strong>Carrera:</strong> <span id="modalCarrera"></span></p>
                    <p><strong>Año de Egreso:</strong> <span id="modalAnioEgreso"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>©️ 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <script>
        function showDetails(data) {
            const details = JSON.parse(data);

            // Actualizar contenido del modal
            document.getElementById('modalNombre').textContent = details.nombre;
            document.getElementById('modalApellidoP').textContent = details.ap_p;
            document.getElementById('modalApellidoM').textContent = details.ap_m;
            document.getElementById('modalTelefono').textContent = details.tel_1;
            document.getElementById('modalCarrera').textContent = details.carrera;
            document.getElementById('modalAnioEgreso').textContent = details.ano_egre;

            // Mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
            modal.show();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>