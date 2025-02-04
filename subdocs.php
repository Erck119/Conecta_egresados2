<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentación</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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
    <p>©️ 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>