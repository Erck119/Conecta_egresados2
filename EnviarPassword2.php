<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Datos de Egresados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
        }
        h1, h2, legend {
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
            margin-bottom: 12px;
            color: #555555;
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
        .banner-img {
            width: 100%;
            height: auto;
            margin-top: 70px;
        }
        .custom-container {
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(249, 249, 249, 0.95);
            box-shadow: 2px 2px 2px rgba(0.2, 0, 0, 0.2);
        }
        
        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            position: relative;
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


    <!-- Banner -->
    <div>
        <img src="images/imagen1.png" alt="Banner" class="banner-img">
    </div>

    <!-- Panel -->
    <div class="container-fluid custom-container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="text-danger fw-bold">TU DOCUMENTO AÚN NO HA SIDO AUTORIZADO</h1>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <fieldset class="border p-4 rounded shadow">
                <legend class="fw-bold text">
                    <i class="zmdi zmdi-account-box"></i> Extensión y Seguimiento de Egresados
                </legend>
                <p>
                    El proceso de atención del Tecnológico de Estudios Superiores de Cuautitlán Izcalli proporciona este servicio de manera gratuita en apoyo a nuestros egresados.
                </p>
            </fieldset>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <fieldset class="border p-4 rounded shadow">
                <legend class="fw-bold text">Información de contacto</legend>
                <p>
                    <strong >Lic. Karina Fabiola Jiménez Olvera</strong><br>
                    Jefa del departamento de Extensión y Seguimiento de Egresados<br>
                    <strong>Tel:</strong> 5558643170 Ext. 406<br>
                    <strong>Correo:</strong> seguimientoegresados@cuautitlan.tecnm.mx
                </p>
            </fieldset>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <fieldset class="border p-4 rounded shadow">
                <legend class="fw-bold text">Ubicación</legend>
                <p>
                    <strong>Secretaría de Educación</strong><br>
                    Av. Nopaltepec s/n Fracción la Coyotera del Ejido San Antonio Cuamatla<br>
                    Cuautitlán Izcalli, Estado de México C.P. 54748
                </p>
            </fieldset>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-6 text-center">
            <img src="images/logo_TESCI_2020.png" alt="Logo TESCI" class="img-fluid w-75">
        </div>
    </div>
</div>


    <!-- Footer -->
    <footer>
        <p>© 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
