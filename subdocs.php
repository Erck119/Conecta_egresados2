
<?php
require 'config.php';
session_start();

// Verifica si el usuario está logueado
if (isset($_SESSION['num_con'])) {
    $num_con = $_SESSION['num_con'];
} else {
    header("Location: login.php");
    exit();
}

// Inicializa mensajes
$mensaje = "";

// Manejo del formulario de subida de archivos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio = "documentos/"; // Carpeta donde se guardarán los archivos
    $archivosSubidos = [];

    // Verifica y mueve los archivos subidos
    foreach (['cartaResidencias', 'boletaIngles', 'titulo'] as $campo) {
        if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] == UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES[$campo]['name']);
            $rutaArchivo = $directorio . $num_con . "/" . $nombreArchivo;

            // Crea el directorio para el num_con si no existe
            if (!is_dir($directorio . $num_con)) {
                mkdir($directorio . $num_con, 0755, true);
            }

            // Mueve el archivo a la ruta deseada
            if (move_uploaded_file($_FILES[$campo]['tmp_name'], $rutaArchivo)) {
                $archivosSubidos[$campo] = $rutaArchivo;
            }
        }
    }

    // Si se subieron archivos, actualiza la base de datos
    if (!empty($archivosSubidos)) {
        // Variables temporales para los archivos
$cartaResidencias = isset($archivosSubidos['cartaResidencias']) ? basename($archivosSubidos['cartaResidencias']) : null;
$boletaIngles = isset($archivosSubidos['boletaIngles']) ? basename($archivosSubidos['boletaIngles']) : null;
$titulo = isset($archivosSubidos['titulo']) ? basename($archivosSubidos['titulo']) : null;

        $query = "SELECT * FROM documentos WHERE num_con = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $num_con);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Si ya existen registros, actualiza
            $updateQuery = "UPDATE documentos SET 
                carta_termino = IFNULL(?, carta_termino),
                boleta_o_ingles = IFNULL(?, boleta_o_ingles),
                titulo = IFNULL(?, titulo)
                WHERE num_con = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param(
                "ssss",
                $cartaResidencias,
                $boletaIngles,
                $titulo,
                $num_con
            );
            $stmt->execute();
        } else {
            // Si no existen registros, inserta nuevos
            $insertQuery = "INSERT INTO documentos (num_con, carta_termino, boleta_o_ingles, titulo) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param(
                "ssss",
                $num_con,
                $cartaResidencias,
                $boletaIngles,
                $titulo
            );
            $stmt->execute();
        }

        $mensaje = "Archivos cargados correctamente.";
    }
}

// Consulta el estado actual de los documentos
$query = "SELECT carta_termino, boleta_o_ingles, titulo FROM documentos WHERE num_con = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $num_con);
$stmt->execute();
$resultado = $stmt->get_result();
$estadoDocumentos = $resultado->fetch_assoc() ?: ['carta_termino' => null, 'boleta_o_ingles' => null, 'titulo' => null];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentación</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFF;
            margin: 0;
            padding: 0px;
        }

        h1 {
            color: #333333;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .boton {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #a62346;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin: 10px 0;
        }

        .boton-volver {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #808080;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .boton:hover {
            background-color: #9c9c9c;
        }

        input[type="file"] {
            display: none;
        }

        label {
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #a62346;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        label:hover {
            background-color: #9c9c9c;
        }

        .center {
            text-align: center;
        }

        .status-icon {
            font-size: 18px;
            margin-left: 10px;
            vertical-align: middle;
        }

        .status-icon.success {
            color: green;
        }

        .status-icon.error {
            color: red;
        }

        .banner-img {
            width: 100%;
            height: auto;
            margin-top: 56px;
        }

            .navbar {
                background-color: #a62346 !important;
            }

            .navbar .dropdown-item:hover {
            background-color: transparent !important; /* Elimina el fondo en hover */
            color: inherit !important; /* Mantiene el color del texto */
            }

        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #a62346;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/rino.png" alt="Logo" style="max-width: 50px; margin-right: 10px;"> EGRESADO
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
                    <ul class="dropdown-menu" style="background-color: #a62346;">
                        <li><a class="dropdown-item text-white" href="registro.php"><i class="zmdi zmdi-labels"></i> Datos</a></li>
                        <li><a class="dropdown-item text-white" href="subdocs.php"><i class="zmdi zmdi-book"></i> Documentos</a></li>
                        <li><a class="dropdown-item text-white" href="descargar.php"><i class="zmdi zmdi-download"></i> Descargar Credencial</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-account-add"></i> Usuario
                    </a>
                    <ul class="dropdown-menu" style="background-color: #a62346;">
                        <li><a class="dropdown-item text-white" href="perfil.php"><i class="zmdi zmdi-labels"></i> Perfil</a></li>
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

<div>
    <img src="images/imagen1.png" alt="Banner" class="banner-img">
</div>

<h1><center>Subir Documentación</center></h1>
<form method="POST" class="center" enctype="multipart/form-data">
    <div class="center" style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px;">
        <label for="cartaResidencias" style="margin: 0;">
            Subir Carta de Término de Residencias (En formato PDF)
        </label>
        <span class="status-icon <?= empty($estadoDocumentos['carta_termino']) ? 'error' : 'success'; ?>">
            <?= empty($estadoDocumentos['carta_termino']) ? '❌' : '✅'; ?>
        </span>
        <input type="file" id="cartaResidencias" name="cartaResidencias" accept=".pdf">
    </div>

    <div class="center" style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px;">
        <label for="boletaIngles" style="margin: 0;">
            Subir Boleta o Carta de Término de Inglés (En formato PDF)
        </label>
        <span class="status-icon <?= empty($estadoDocumentos['boleta_o_ingles']) ? 'error' : 'success'; ?>">
            <?= empty($estadoDocumentos['boleta_o_ingles']) ? '❌' : '✅'; ?>
        </span>
        <input type="file" id="boletaIngles" name="boletaIngles" accept=".pdf">
    </div>

    <div class="center" style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px;">
        <label for="titulo" style="margin: 0;">
            Subir Título (En formato PDF)
        </label>
        <span class="status-icon <?= empty($estadoDocumentos['titulo']) ? 'error' : 'success'; ?>">
            <?= empty($estadoDocumentos['titulo']) ? '❌' : '✅'; ?>
        </span>
        <input type="file" id="titulo" name="titulo" accept=".pdf">
    </div>

    <br>
    <div class="center">
        <input type="submit" value="Guardar Documentos" class="boton">
        <a href="egresados.php" class="boton-volver">Regresar a Página Principal</a>
        <br><br>
    </div>
</form>

<footer>
<p>© 2025 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>