

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentación</title>
    <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #FFFFF; /* Un color de fondo más suave */
            margin: 0;
            padding: 0px;
        }

        h1 {
            color: #333333;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco translúcido */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Sombra suave */
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
            margin: 10px 0; /* Espaciado entre botones */
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

        .boton-salir {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #FF0000;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .boton:hover {
            background-color: #9c9c9c;
        }
        
        
        input[type="submit"] {
            background-color: #9c9c9c;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
        /* Centrar el contenido */
        .center {
            text-align: center;
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




    <h1><center>Subir Documentación</center></h1>

    <form method="POST" class="center">
        <br>
        <!-- Botones para subir archivos centrados -->
        <div class="center">
            <a href="escoger_archivo.php"  class="boton">Subir Carta de Término de Residencias (En formato PNG)</a>
            <br><br>
            <a href="escoger_archivo.php"  class="boton">Subir Boleta o Carta de Término de inglés (En formato PNG)</a>
            <br><br>
            <a href="escoger_archivo.php"  class="boton">Subir Título (En formato PNG)</a>
        </div>
        <br>
        <div class="center">
        <a href="egresados.php" class="boton-volver">Regresar a Página Principal</a>
        <br><br>
    </div>

    </form>


    
</div>
<footer class="text-center py-3">
        <p>&copy; 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli</p>
    </footer>
    
    <script>
    function mostrarCheck(num) {
        // Mostrar la palomita junto al archivo correspondiente
        document.getElementById('check_' + num).style.visibility = 'visible';
    }
</script>
</body>
<!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


</html>