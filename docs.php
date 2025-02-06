<?php
require 'config.php'; // Conexión a la base de datos

// Ruta base de los documentos en el servidor
$baseDir = "C:/xampp/htdocs/conecta_egresados/documentos"; // Ruta física
$baseUrl = "http://localhost/conecta_egresados/documentos"; // URL pública

// Verificar si el directorio existe
if (!is_dir($baseDir)) {
    die("El directorio 'documentos' no existe.");
}

// Función para obtener las carpetas que coinciden con la búsqueda
function listarCarpetas($ruta, $filtro = '') {
    $elementos = array_diff(scandir($ruta), array('.', '..'));
    $resultado = [];
    foreach ($elementos as $elemento) {
        $rutaCompleta = $ruta . '/' . $elemento;
        // Solo buscar carpetas que coincidan con el filtro (número de control)
        if (is_dir($rutaCompleta) && stripos($elemento, $filtro) !== false) {
            $resultado[$elemento] = listarArchivos($rutaCompleta); // Recursión para obtener los archivos dentro de la carpeta
        }
    }
    return $resultado;
}

// Función para obtener los archivos dentro de una carpeta
function listarArchivos($ruta) {
    $elementos = array_diff(scandir($ruta), array('.', '..'));
    return $elementos;
}

// Si se recibe una búsqueda, se filtra el contenido
$search = isset($_GET['search']) ? $_GET['search'] : '';
$contenido = listarCarpetas($baseDir, $search);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentos de Estudiantes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 70px;
            background-color: #f9f9f9;
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

        .custom-container {
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(249, 249, 249, 0.95);
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

        #search {
            width: 70%;
            max-width: 600px;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #a62346;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #72122e;
        }

        .file-list ul {
            list-style: none;
            padding: 0;
        }

        .file-list li {
            background-color: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .file-link {
            text-decoration: none;
            color: #a62346;
        }

        .file-link:hover {
            text-decoration: underline;
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

    <!-- Barra de búsqueda -->
    <div class="container mt-5">
        <h1 class="text-center">Buscar Documentos de Estudiantes</h1>
        <form method="get" class="text-center mb-4">
            <input type="text" name="search" id="search" class="form-control d-inline-block" placeholder="Buscar por número de control" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-custom ms-2">Buscar</button>
        </form>
    </div>

    <!-- Mostrar carpetas y archivos -->
    <div class="container file-list">
        <h2 class="text-center">Documentos Disponibles</h2>
        <?php if (empty($contenido)): ?>
            <p class="text-center">No se encontraron resultados para la búsqueda "<?php echo htmlspecialchars($search); ?>".</p>
        <?php else: ?>
            <ul>
                <?php foreach ($contenido as $carpeta => $archivos): ?>
                    <h3 class="folder-title">Carpeta: <?php echo htmlspecialchars($carpeta); ?></h3>
                    <ul>
                        <?php foreach ($archivos as $archivo): ?>
                            <li>
                                <a href="<?php echo $baseUrl . '/' . $carpeta . '/' . $archivo; ?>" target="_blank" class="file-link"><?php echo htmlspecialchars($archivo); ?></a>
                                <button type="button" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#confirmModal" data-archivo="<?php echo htmlspecialchars($archivo); ?>" data-carpeta="<?php echo htmlspecialchars($carpeta); ?>">Eliminar</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación de Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este archivo?
                </div>
                <div class="modal-footer">
                    <form method="post" action="eliminar_archivo.php" id="deleteForm">
                        <input type="hidden" name="archivo" id="archivoToDelete">
                        <input type="hidden" name="carpeta" id="carpetaToDelete">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
    <p>©️ 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Script para manejar la apertura del modal y pasar los datos -->
    <script>
        var confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // El botón que disparó el modal
            var archivo = button.getAttribute('data-archivo');
            var carpeta = button.getAttribute('data-carpeta');

            // Establecer los valores en el formulario del modal
            document.getElementById('archivoToDelete').value = archivo;
            document.getElementById('carpetaToDelete').value = carpeta;
        });
    </script>
</body>
</html>