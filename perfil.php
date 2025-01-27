<?php
require 'config.php';
session_start();

function redirectWithStyle($message, $redirectUrl)
{
    echo "
    <html>
    <head>
        <title>Redirigiendo...</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background: linear-gradient(135deg, #ece9e6, #ffffff);
            }
            .redirect-box {
                text-align: center;
                border: 2px solid #ddd;
                padding: 20px;
                border-radius: 10px;
                background-color: #f9f9f9;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .redirect-box h1 {
                color: #333;
                font-size: 24px;
            }
            .redirect-box p {
                color: #555;
                font-size: 16px;
            }
            .redirect-box a {
                text-decoration: none;
                color: #ffffff;
                background: #a62346;
                padding: 10px 15px;
                border-radius: 5px;
                transition: background 0.3s;
            }
            .redirect-box a:hover {
                background: #9c9c9c;
            }
        </style>
    </head>
    <body>
        <div class='redirect-box'>
            <h1>¡Oops!</h1>
            <p>$message</p>
            <a href='$redirectUrl'>Haga clic aquí si no fue redirigido automáticamente</a>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = '$redirectUrl';
            }, 3000);
        </script>
    </body>
    </html>
    ";
    exit();
}

// Verificar si la sesión contiene el num_con
if (!isset($_SESSION['num_con'])) {
    header('Location: login.php'); // Redirige a la página de inicio de sesión si no está logueado
    exit();
}

// Obtener el número de control de la sesión
$num_con = $_SESSION['num_con'];

// Inicializar variables
$nombre = $ap_p = $ap_m = $carrera = $ano_egre = '';

// Consulta para obtener los datos del usuario basados en el num_con
$query = "SELECT nombre, ap_p, ap_m, carrera, ano_egre FROM datos WHERE num_con = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $num_con); // Vincular el num_con a la consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nombre = $user['nombre'];
    $ap_p = $user['ap_p'];
    $ap_m = $user['ap_m'];
    $carrera = $user['carrera'];
    $ano_egre = $user['ano_egre'];

    $_SESSION['nombre'] = $nombre;
    $_SESSION['ap_p'] = $ap_p;
    $_SESSION['ap_m'] = $ap_m;
    $_SESSION['carrera'] = $carrera;
    $_SESSION['ano_egre'] = $ano_egre;
} else {
    // Redirigir con estilo
    redirectWithStyle(
        "No hemos encontrado tus datos. Por favor completa el formulario de registro para continuar.",
        "registro.php"
    );
}

$stmt->close();

// Verificar si el campo 'carrera' está vacío
if (empty($carrera)) {
    // Redirigir a una página amigable de registro o edición si el campo 'carrera' está vacío
    redirectWithStyle(
        "Por favor, completa el formulario para acceder a este apartado.",
        "registro.php"
    );
}

// Verificar si algún dato esencial falta
if (empty($nombre) || empty($ap_p) || empty($ano_egre)) {
    // Redirigir a una página amigable de registro o edición
    header('Location: registro.php?incompleto=1'); 
    exit();
}

// Manejo de imagen del perfil
$profileImagePath = null; // Se asegura que la variable se declare antes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $error = "";

        // Crear el directorio si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $num_con . '_' . basename($_FILES['profile_image']['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Validar las extensiones y los tipos MIME permitidos
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $fileType = mime_content_type($fileTmpPath);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Comprobar tipo de archivo y extensión
        if (in_array($fileExtension, $allowedExtensions) && in_array($fileType, $allowedMimeTypes)) {
            // Si el archivo ya existe, cambiar el nombre para evitar sobrescritura
            if (file_exists($targetFilePath)) {
                $fileName = $num_con . '_' . time() . '_' . basename($_FILES['profile_image']['name']);
                $targetFilePath = $uploadDir . $fileName;
            }

            // Intentar mover el archivo a la carpeta de destino
            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                $profileImagePath = $targetFilePath;  // Ruta final de la imagen subida
            } else {
                $error = "Hubo un error al mover el archivo.";
            }
        } else {
            $error = "Solo se permiten archivos de imagen JPG, JPEG, y PNG.";
        }
    } elseif ($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
        $error = "Hubo un error en la carga del archivo. Código de error: " . $_FILES['profile_image']['error'];
    }

    // Verificación para eliminar imagen
    if (isset($_POST['delete_image']) && isset($profileImagePath) && file_exists($profileImagePath)) {
        if (unlink($profileImagePath)) {
            $profileImagePath = null;  // Eliminar la referencia a la imagen
        } else {
            $error = "No se pudo borrar la imagen.";
        }
    } elseif (isset($_POST['delete_image']) && !isset($profileImagePath)) {
        $error = "No se encontró ninguna imagen para borrar.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil del egresado</title>
  <style>

    /*DISEÑO NAVBAR*/
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

            /* FIN DISEÑO NAVBAR*/

  
      /*DISEÑO NUEVO */
      
      .custom-container {
        border: 1px solid rgba(0, 0, 0, 0.2); /* Borde más transparente */
            padding: 20px;
            border-radius: 10px;
            background-color: white; /* Fondo más claro */
            height: 100%;
            box-shadow: 2px 2px 2px 2px rgba(0.2, 0, 0, 0.2);
            bottom: 10px;
        }

        .profile-img img {
            max-width: 100%;
            max-height: 550px;
            border-radius: 8px;
            border: 2px solid #a62346;
            object-fit: cover;
        }

        .btn-back {
            background-color: #a62346;
            color: white;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #72122e;
            color: white;
        }

        .text-center img {
            max-width: 80%;
            margin-top: 15px;
        }

        /* Estilos específicos para centrar los contenedores en pantalla */
        .container-fluid {
            width: 100%;
            max-width: 1200px; /* Ancho máximo del contenedor */
        }

        @media (max-width: 768px) {
            .custom-container {
                margin-bottom: 20px;
            }
        }

      /* FIN DISEÑO NUEVO */

          /*DISEÑO FOOTER*/
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
                  /* FIN DISEÑO FOOTER*/

                  /*ESTILO BOTONES SUBIR Y ELIMINAR IMAGEN */

/* Botón de subir imagen */
 .col-md-4 .btn-upload {
    background-color: #ffc107; /* Amarillo */
    color: black;
}

.col-md-4 .btn-upload:hover {
    background-color: #e0a800; /* Amarillo más oscuro */
    color: black;
}

/* Botón de eliminar imagen */
.col-md-4 .btn-delete {
    background-color: #dc3545; /* Rojo */
    color: white;
}

.col-md-4 .btn-delete:hover {
    background-color: #c82333; /* Rojo más oscuro */
    color: white;
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
                        <li><a class="dropdown-item text-white" href="registro.php"><i class="zmdi zmdi-labels"></i> Formulario</a></li>
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
               
            </ul>
        </div>
    </div>
</nav>


    <!-- Imagen de banner -->
    <div>
        <img src="images/imagen1.png" alt="Banner" class="banner-img">
    </div>



<!-- Contenedor Principal -->

<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <!-- Contenedor Izquierdo: Foto del Egresado -->
        <div class="col-md-4">
            <div class="custom-container">
                <h2 class="text-center">Foto del Egresado</h2>
                <div class="profile-img text-center">
                    <img src="<?php echo htmlspecialchars($profileImagePath); ?>" alt="Foto del Egresado">
                </div>
                <!-- Formulario para subir imagen -->
                <form action="perfil.php" method="POST" enctype="multipart/form-data" class="mt-3">
                    <div class="mb-3">
                    <input type="file" name="profile_image" accept=".jpg, .jpeg, .png" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-upload btn-block">Subir Imagen</button>
                </form>

                <!-- Botón para borrar imagen -->
            <?php if (isset($profileImagePath)): ?>
                <form action="perfil.php" method="POST" class="mt-2">
                <button type="submit" name="delete_image" class="btn btn-delete btn-block">Eliminar Imagen</button>
                  </form>
            <?php endif; ?>

                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
            </div>
        </div>

           <!-- Contenedor Derecho: Información del Egresado -->
           <div class="col-md-7">
            <div class="custom-container">
                <h2 class="text-center">Información del Egresado</h2>
                <p><strong>Número de Control:</strong> <?php echo htmlspecialchars($num_con); ?></p>
                <p><strong>Nombre(s):</strong> <?php echo htmlspecialchars($nombre); ?></p>
                <p><strong>Apellido Paterno:</strong> <?php echo htmlspecialchars($ap_p); ?></p>
                <p><strong>Apellido Materno:</strong> <?php echo htmlspecialchars($ap_m); ?></p>
                <p><strong>Carrera:</strong> <?php echo htmlspecialchars($carrera); ?></p>
                <p><strong>Año de Egreso:</strong> <?php echo htmlspecialchars($ano_egre); ?></p>
                <div class="text-center">
                    <img src="images/rino_plasta_negro.png" alt="Logo" width="30%">
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>© 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>
</body>
<!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


</html>