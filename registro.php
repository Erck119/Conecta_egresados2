<?php
require 'config.php';
session_start();

// Verifica si el usuario está logueado
if (isset($_SESSION['num_con'])) {
    $num_con = $_SESSION['num_con'];
    $nombre = ''; 
    $ap_p = '';    
    $ap_m = '';    
    $sexo = '';
    $email1 = '';
    $tel1 = '';
    $tel2 = '';
    $cedula = '';
    $carrera = '';
    $ano_egre = '';

    // Realiza la consulta a la base de datos
    $query = "SELECT nombre, ap_p, ap_m, sexo, num_con, email_1, tel_1, tel_2, cedula, carrera, ano_egre FROM datos WHERE num_con = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $num_con);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $ap_p = $row['ap_p'];
        $ap_m = $row['ap_m'];
        $sexo = $row ['sexo'];
        $num_con = $row['num_con'];
        $email1 = $row['email_1'];
        $tel1 = $row['tel_1'];
        $tel2 = $row['tel_2'];
        $cedula = $row['cedula'];
        $carrera = $row['carrera'];
        $ano_egre = $row['ano_egre'];
    } else {
        echo "No se encontraron datos del usuario.";
    }

    $stmt->close();
} else {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario de Datos de Egresados</title>
    <!-- Meta Tag para Hacer la Página Responsiva -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <style>
          /* Fondo de la página */
          body {
            font-family: Arial, sans-serif;
            background-color: #FFFFF; /* Un color de fondo más suave */
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333333;
        }

        /* Estilo del formulario */
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

        label {
            display: block;
            margin-bottom: 10px;
            color: #555555;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        /* Botón de Enviar */
        input[type="submit"] {
            background-color: #008000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
            margin: 0 auto;
            display: block;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilos para los botones de enlace */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .link-button {
            background-color: #FF0000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s;
        }

        .link-button-2 {
            background-color: #808080;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s;
        }

        .link-button:hover {
            background-color: #555;
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
        /*ESTILOS VALIDACION */
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }
        .input-group input {
            width: 100%;
            padding-right: 30px;
        }
        .status-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            display: none; /* Oculto por defecto */
        }
        .status-icon.correct {
            display: block;
            color: green;
        }
        .status-icon.incorrect {
            display: block;
            color: red;
        }
    </style>
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




<div class="container">
     

        <h1 class="text-center">Datos de Egresados</h1>

        <form method="POST" action="registrar.php" onsubmit="return validarFormulario();">
        <div class="mb-3">
    <label for="num_con" class="form-label">Número de Control</label>
    <input type="text" id="num_con" name="num_con" value="<?php echo htmlspecialchars($num_con); ?>" class="form-control" readonly>
</div>

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre(s)</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" class="form-control" readonly>
</div>

<div class="mb-3">
    <label for="ap_p" class="form-label">Apellido Paterno</label>
    <input type="text" id="ap_p" name="ap_p" value="<?php echo htmlspecialchars($ap_p); ?>" class="form-control" readonly>
</div>
<div class="mb-3">
    <label for="ap_m" class="form-label">Apellido Materno</label>
    <input type="text" id="ap_m" name="ap_m" value="<?php echo htmlspecialchars($ap_m); ?>" class="form-control" readonly>
</div>

<div class="mb-3">
    <label for="ap_m" class="form-label">Sexo</label>
    <select  id="sexo" name="sexo"  class="form-select" readonly>
    <option value=""></option>
        <option value="Masculino" <?php echo ($sexo == "Masculino") ? 'selected' : ''; ?>>Masculino</option>
        <option value="Femenino" <?= $sexo == 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
        </select>

</div>
<div class="input-group">
            <label for="tel_1">Celular</label>
            <input type="tel" id="tel_1" name="tel_1" placeholder="Número de 10 dígitos" required>
            <span id="icon_tel1" class="status-icon">✔</span>
        </div>
        <!-- Celular Alternativo -->
        <div class="input-group">
            <label for="tel_2">Celular Alternativo</label>
            <input type="tel" id="tel_2" name="tel_2" placeholder="Opcional, 10 dígitos">
            <span id="icon_tel2" class="status-icon">✔</span>
        </div>
        <!-- Correo Electrónico -->
        <div class="input-group">
            <label for="email_1">Correo Electrónico</label>
            <input type="email" id="email_1" name="email_1" placeholder="Correo válido" required>
            <span id="icon_email1" class="status-icon">✔</span>
        </div>
<div class="mb-3">
    <label for="cedula" class="form-label">Cédula</label>
    <input type="text" id="cedula" name="cedula" value="<?php echo htmlspecialchars($cedula); ?>" class="form-control">
</div>

<div class="mb-3">
    <label for="carrera" class="form-label">Carrera</label>
    <select id="carrera" name="carrera" class="form-select" >
        <option value=""></option>
        <option value="Ingenieria en Electrónica" <?php echo ($carrera == "Ingenieria en Electrónica") ? 'selected' : ''; ?>>Ingenieria Electrónica</option>
        <option value="Ingenieria en Informática" <?= $carrera == 'Ingenieria en Informática' ? 'selected' : ''; ?>>Ingeniería en Informática</option>
        <option value="Licenciatura en Informatica" <?= $carrera == 'Licenciatura en Informatica' ? 'selected' : ''; ?>>Licenciatura en Informática</option>
        <option value="Licenciatura en Contador Publico" <?= $carrera == 'Licenciatura en Contador Publico' ? 'selected' : ''; ?>>Licenciatura en Contador Público</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingenieria en Sistemas Computacionales' ? 'selected' : ''; ?>>Ingeniería en Sistemas Computacionales</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingenieria en Gestion Empresarial' ? 'selected' : ''; ?>>Ingeniería en Gestion Empresarial</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingeniería en Tecnologías de la Información y Comunicacionesl' ? 'selected' : ''; ?>>Ingeniería en Tecnologías de la Información y Comunicaciones</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Contador Público' ? 'selected' : ''; ?>>Contador Público</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingeniería Industrial' ? 'selected' : ''; ?>>Ingeniería Industrial</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingeniería en Logística ' ? 'selected' : ''; ?>>Ingeniería en Logística </option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingeniería en Administración ' ? 'selected' : ''; ?>>Ingeniería en Administración </option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingeniería Mecatrónica ' ? 'selected' : ''; ?>>Ingeniería Mecatrónica</option>
        <option value="Ingenieria en Sistemas Computacionales" <?= $carrera == 'Ingeniería  Química' ? 'selected' : ''; ?>>Ingeniería Química</option>
        
          </select>
            </div>


            <div class="mb-3">
    <label for="ano_egre" class="form-label">Año de Egreso</label>
    <select id="ano_egre" name="ano_egre" class="form-select">
        <option value=""></option>
        <option value="1999" <?php echo ($ano_egre == "1999") ? 'selected' : ''; ?>>1999</option>
        <option value="2000" <?php echo ($ano_egre == "2000") ? 'selected' : ''; ?>>2000</option>
        <option value="2001" <?php echo ($ano_egre == "2001") ? 'selected' : ''; ?>>2001</option>
        <option value="2002" <?php echo ($ano_egre == "2002") ? 'selected' : ''; ?>>2002</option>
        <option value="2003" <?php echo ($ano_egre == "2003") ? 'selected' : ''; ?>>2003</option>
        <option value="2004" <?php echo ($ano_egre == "2004") ? 'selected' : ''; ?>>2004</option>
        <option value="2005" <?php echo ($ano_egre == "2005") ? 'selected' : ''; ?>>2005</option>
        <option value="2006" <?php echo ($ano_egre == "2006") ? 'selected' : ''; ?>>2006</option>
        <option value="2007" <?php echo ($ano_egre == "2007") ? 'selected' : ''; ?>>2007</option>
        <option value="2008" <?php echo ($ano_egre == "2008") ? 'selected' : ''; ?>>2008</option>
        <option value="2009" <?php echo ($ano_egre == "2009") ? 'selected' : ''; ?>>2009</option>
        <option value="2010" <?php echo ($ano_egre == "2010") ? 'selected' : ''; ?>>2010</option>
        <option value="2011" <?php echo ($ano_egre == "2011") ? 'selected' : ''; ?>>2011</option>
        <option value="2012" <?php echo ($ano_egre == "2012") ? 'selected' : ''; ?>>2012</option>
        <option value="2013" <?php echo ($ano_egre == "2013") ? 'selected' : ''; ?>>2013</option>
        <option value="2014" <?php echo ($ano_egre == "2014") ? 'selected' : ''; ?>>2014</option>
        <option value="2015" <?php echo ($ano_egre == "2015") ? 'selected' : ''; ?>>2015</option>
        <option value="2016" <?php echo ($ano_egre == "2016") ? 'selected' : ''; ?>>2016</option>
        <option value="2017" <?php echo ($ano_egre == "2017") ? 'selected' : ''; ?>>2017</option>
        <option value="2018" <?php echo ($ano_egre == "2018") ? 'selected' : ''; ?>>2018</option>
        <option value="2029" <?php echo ($ano_egre == "2019") ? 'selected' : ''; ?>>2019</option>
        <option value="2020" <?php echo ($ano_egre == "2020") ? 'selected' : ''; ?>>2020</option>
        <option value="2021" <?php echo ($ano_egre == "2021") ? 'selected' : ''; ?>>2021</option>
        <option value="2022" <?php echo ($ano_egre == "2022") ? 'selected' : ''; ?>>2022</option>
        <option value="2023" <?php echo ($ano_egre == "2023") ? 'selected' : ''; ?>>2023</option>
        <option value="2024" <?php echo ($ano_egre == "2024") ? 'selected' : ''; ?>>2024</option>

    </select>
      </div>

      

            <div class="d-flex justify-content-center">
                <input class="btn btn-success" type="submit" name="register" value="Enviar">
            </div>

            <div class="button-group">
                <a class="link-button-2" href="egresados.php">Regresar a Página Principal</a>
                <a class="link-button" href="login.php">Salir</a>
            </div>
        </form>
    </div>

    <footer>
    <p>© 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
</footer>

 <script>
            // Validaciones en tiempo real
            const regexTelefono = /^\d{10}$/; // Número de celular con 10 dígitos
        const tel1Input = document.getElementById('tel_1');
        const tel2Input = document.getElementById('tel_2');
        const email1Input = document.getElementById('email_1');

        const tel1Icon = document.getElementById('icon_tel1');
        const tel2Icon = document.getElementById('icon_tel2');
        const email1Icon = document.getElementById('icon_email1');

        function validarInput(input, regex, icon) {
            if (input.value.match(regex)) {
                icon.style.color = 'green';
                icon.textContent = '✔'; // Flecha verde
                icon.style.display = 'inline-block';
            } else if (input.value === '') {
                icon.style.display = 'none'; // No mostrar icono si está vacío
            } else {
                icon.style.color = 'red';
                icon.textContent = '✖'; // Tache rojo
                icon.style.display = 'inline-block';
            }
        }

        // Escuchar cambios en los inputs
        tel1Input.addEventListener('input', () => validarInput(tel1Input, regexTelefono, tel1Icon));
        tel2Input.addEventListener('input', () => validarInput(tel2Input, regexTelefono, tel2Icon));
        email1Input.addEventListener('input', () => validarInput(email1Input, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, email1Icon));

        // Validación al enviar formulario
        function validarFormulario() {
            let valid = true;
            validarInput(tel1Input, regexTelefono, tel1Icon);
            validarInput(tel2Input, regexTelefono, tel2Icon);
            validarInput(email1Input, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, email1Icon);

            // Verificar si algún campo es incorrecto
            if (!tel1Input.value.match(regexTelefono)) valid = false;
            if (tel2Input.value && !tel2Input.value.match(regexTelefono)) valid = false;
            if (!email1Input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) valid = false;

            return valid; // Enviar formulario solo si todo es válido
        }
 </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</html>