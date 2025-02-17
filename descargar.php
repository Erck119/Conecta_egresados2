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
            .alert-box {
                text-align: center;
                border: 2px solid #ddd;
                padding: 20px;
                border-radius: 10px;
                background-color: #f9f9f9;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .alert-box h1 {
                color: #f44336;
                font-size: 24px;
            }
            .alert-box p {
                color: #555;
                font-size: 16px;
            }
            .alert-box a {
                text-decoration: none;
                color: #ffffff;
                background: #a62346;
                padding: 10px 15px;
                border-radius: 5px;
                transition: background 0.3s;
            }
            .alert-box a:hover {
                background: #9c9c9c;
            }
            .button-group {
                margin-top: 15px;
            }
            .button-group a {
                background: #a62346;
                margin-left: 10px;
            }
            .button-group a:hover {
                background: #9c9c9c;
            }
        </style>
    </head>
    <body>
        <div class='alert-box'>
            <h1>¡No tienes autorización!</h1>
            <p>$message</p>
            <div class='button-group'>
                <a href='egresados.php'>Volver a la página principal</a>
                <a href='AUTORIZACION.php'>Más información</a> <!-- Botón de autorización -->
            </div>
        </div>
    </body>
    </html>
    ";
    exit();
}

// Verificar si el número de control está en la sesión
if (isset($_SESSION['num_con'])) {
    $num_con = $_SESSION['num_con'];

    // Realizar consulta a la base de datos para obtener la información
    $query = "SELECT * FROM datos WHERE num_con = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $num_con);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron datos del usuario
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $nombre = $user['nombre'];
        $ap_p = $user['ap_p'];
        $ap_m = $user['ap_m'];
        $carrera = $user['carrera'];
        $ano_egre = $user['ano_egre'];
        $estado = trim($user['estado']); // Elimina espacios al inicio y al final

        // Si el campo 'carrera' está vacío, redirigir con mensaje
        if (empty($ano_egre)) {
            redirectWithStyle("Por favor, completa tu registro antes de acceder a este apartado.", "registro.php");
        }

        // Verificar si se presionó el botón de descarga
        if (isset($_POST['descargar'])) {
            if ($estado === 'Aceptar') {
                // Redirigir al archivo generar_credencial.php
                header("Location: generar_credencial.php");
                exit();
            } else {
                redirectWithStyle("Tu solicitud aún no ha sido aceptada o ha sido negada.", "egresados.php");
            }
        }

        // Asignar datos a la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['ap_p'] = $ap_p;
        $_SESSION['ap_m'] = $ap_m;
        $_SESSION['carrera'] = $carrera;
        $_SESSION['ano_egre'] = $ano_egre;

    } else {
        // Si no se encuentran datos del usuario, redirigir con el mensaje
        redirectWithStyle("No se encontraron tus datos en el sistema. Completa el registro para continuar.", "registro.php");
    }
} else {
    echo "Por favor, inicia sesión para acceder a esta información.";
}


// Crear las variables para JavaScript
echo '<script>';
echo 'var nombre = "' . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . '";';
echo 'var ap_p = "' . htmlspecialchars($ap_p, ENT_QUOTES, 'UTF-8') . '";';
echo 'var ap_m = "' . htmlspecialchars($ap_m, ENT_QUOTES, 'UTF-8') . '";';
echo 'var carrera = "' . htmlspecialchars($carrera, ENT_QUOTES, 'UTF-8') . '";';
echo 'var ano_egre = "' . htmlspecialchars($ano_egre, ENT_QUOTES, 'UTF-8') . '";';
echo '</script>';
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
<title>Formulario de Datos de Egresados</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #FFFF;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    flex-direction: column;
  }

  .header-container {
    width: 100%; /* Se asegura de ocupar todo el ancho disponible */
    max-height: 250px; /* Incrementamos la altura máxima del contenedor */
    overflow: hidden; /* Evitamos que la imagen sobresalga */
  }

  .header-container img {
    width: 100%; /* Se adapta al ancho del contenedor */
    height: auto; /* Mantiene las proporciones */
    display: block; /* Elimina espacios extra alrededor de la imagen */
    object-fit: cover; /* Llena el contenedor y corta el contenido extra si es necesario */
  }

  h1 {
    color: #333333;
    text-align: center;
  }

  form {
    background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco translúcido */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Sombra suave */
    width: 90%; /* Ancho predeterminado para pantallas pequeñas */
    max-width: 600px; /* Máximo ancho en pantallas grandes */
    margin: 10px auto; /* Centrado horizontal */
  }

  label {
    display: block;
    margin-bottom: 10px;
    color: #555555;
    text-align: left;
  }
  .banner-img {
            width: 100%;
            height: auto;
            margin-top: 56px; /* Espacio para evitar que el navbar cubra la imagen */
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

        .navbar {
            background-color: #a62346 !important;
        }

        .navbar .dropdown-item:hover {
        background-color: transparent !important; /* Elimina el fondo en hover */
        color: inherit !important; /* Mantiene el color del texto */
        }

        .navbar .dropdown-item:hover {
            background-color: #72122e;
        }

        .content {
            padding: 20px;
        }

  input[type="text"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #cccccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 20px;
    text-align: center;
    font-size: 16px;
  }

  .boton-salir, .boton-volver, .boton-crede, .boton-foto {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
    text-align: center;
    margin: 5px;
    cursor: pointer;
  }

  .boton-salir { background-color: #FF0000; }
  .boton-volver { background-color: #808080; }
  .boton-crede { background-color: #008000; }
  .boton-foto { background-color: #000000; }

  .boton-salir:hover { background-color: #cc0000; }
  .boton-volver:hover { background-color: #666666; }
  .boton-crede:hover { background-color: #006400; }
  .boton-foto:hover { background-color: #333333; }

  .button-group {
    display: flex;
    justify-content: center;
    flex-wrap: wrap; /* Permite que los botones se ajusten en líneas */
  }

  /* Media Queries */
  @media (max-width: 768px) {
    .header-container {
      max-height: 180px; /* Reducimos un poco la altura máxima en pantallas pequeñas */
    }

    form {
      width: 95%; /* Ajusta el ancho del formulario */
    }
  }

  @media (min-width: 1200px) {
    form {
      width: 50%; /* Aún más ancho en pantallas grandes */
    }
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




    <!-- Imagen de banner -->
    <div>
        <img src="images/imagen1.png" alt="Banner" class="banner-img">
    </div>


<h1>Descarga de Credencial</h1>

<form method="POST">
 
<input type="text" value="<?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : ''; ?>" name="nombre" readonly>

<label for="ap_p">Apellido Paterno</label>
<input type="text" value="<?php echo isset($_SESSION['ap_p']) ? htmlspecialchars($_SESSION['ap_p']) : ''; ?>" name="ap_p" readonly>

<label for="ap_m">Apellido Materno</label>
<input type="text" value="<?php echo isset($_SESSION['ap_m']) ? htmlspecialchars($_SESSION['ap_m']) : ''; ?>" name="ap_m" readonly>

<label for="carrera">Carrera</label>
<input type="text" value="<?php echo isset($_SESSION['carrera']) ? htmlspecialchars($_SESSION['carrera']) : ''; ?>" name="carrera" readonly placeholder= "Realiza el registro para mostrar tu informacion">

<label for="ano_egre">Año de Egreso</label>
<input type="text" value="<?php echo isset($_SESSION['ano_egre']) ? htmlspecialchars($_SESSION['ano_egre']) : ''; ?>" name="ano_egre" readonly  placeholder= "Realiza el registro para mostrar tu informacion">



  <br>
  <form method="POST" action="descargar.php">

  <div class="button-group">
    <a href="escoger_archivo_credencial.php" class="boton-foto" >Foto del Egresado (En Formatos PNG)</a>
    <button type="submit" name="descargar" class="boton-crede">Descargar Credencial</button>
  </div>

  <br>
  <div class="button-group">
    <a class="boton-volver" href="egresados.php">Regresar a Página Principal</a>
  </div>
</form>

<?php include("registrar.php"); ?>

<footer>
<p>© 2025 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>
</body>
<!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</html>