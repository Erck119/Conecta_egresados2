<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <title>Formulario de Datos de Egresados</title>

    <!-- Bootstrap CSS -->

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
                        Documentación
                    </a>
                    <ul class="dropdown-menu" style="background-color: #a62346;">
                        <li><a class="dropdown-item text-white" href="registro.php">Formulario</a></li>
                        <li><a class="dropdown-item text-white" href="subdocs.php">Documentos</a></li>
                        <li><a class="dropdown-item text-white" href="descargar.php">Descargar Credencial</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuario
                    </a>
                    <ul class="dropdown-menu" style="background-color: #a62346;">
                        <li><a class="dropdown-item text-white" href="perfil.php">Perfil</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Pestañas alineadas a la derecha -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="egresados.php">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" title="Salir">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Imagen de banner -->
    <div>
        <img src="images/imagen1.png" alt="Banner" class="banner-img">
    </div>

    <!-- Formulario e información -->
    <div class="container mt-4 custom-container">
        <h1>¿Se te olvidó la contraseña?</h1>
        <p>
            Si tienes alguna duda o queja, acércate con nosotros. El proceso de atención del Tecnológico de Estudios Superiores de Cuautitlán Izcalli proporciona este servicio de manera gratuita en apoyo a nuestros egresados.
        </p>
        <h2>Información de contacto</h2>
        <p>
            Lic. Karina Fabiola Jiménez Olvera, Jefa del departamento de Extensión y Seguimiento de Egresados. <br>
            Tel: 5558643170 Ext. 406 <br>
            Correo: <a href="mailto:seguimientoegresados@cuautitlan.tecnm.mx">seguimientoegresados@cuautitlan.tecnm.mx</a>
        </p>
        <h2>Ubicación</h2>
        <p>
            Secretaría de Educación Av. Nopaltepec s/n Fracción la Coyotera del Ejido San Antonio Cuamatla, Cuautitlán Izcalli, Estado de México C.P. 54748.
        </p>
        <img src="images/logo_TESCI_2020.png" alt="Logo TESCI" style="max-width: 60%; height: auto;">

    </div>

    <!-- Footer -->
    <footer>
        <p>© 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA4O3I5YpOe41gLoB2ddI4zLfIhVJOb1FEK3NI1MwUxS3A" crossorigin="anonymous"></script>
</body>
</html>
