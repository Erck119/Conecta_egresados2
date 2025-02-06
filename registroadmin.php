<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $ap_p = $_POST['ap_p'];
    $ap_m = $_POST['ap_m'];
    $num_con = $_POST['num_con'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $confirmcontraseña = $_POST['confirmcontraseña'];
    $rol = $_POST['rol'];
    $carrera= $_POST['carrera'];

    $duplicate = mysqli_query($conn, "SELECT * FROM usuarios WHERE num_con = '$num_con' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('El nombre de usuario o el correo electrónico ya está registrado');</script>";
    } else {
        if ($contraseña == $confirmcontraseña) {
            $hashedPassword = password_hash($contraseña, PASSWORD_BCRYPT);
            $query = "INSERT INTO usuarios (num_con, nombre, ap_p, ap_m ,contrasena, rol, email, carrera) VALUES ('$num_con', '$nombre', '$ap_p', '$ap_m', '$hashedPassword', '$rol', '$email', '$carrera')";
            mysqli_query($conn, $query);
            echo "<script>alert('Registro exitoso');</script>";
        } else {
            echo "<script>alert('Las contraseñas no coinciden');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administradores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 500px;
        }
        form label {
            color: #555555;
            font-weight: bold;
        }
        form input, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #a62346;
            color: white;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #72122e;
        }
        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            margin-top: 50px;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/rino.png" alt="Logo"> ADMINISTRADOR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownAdministracion" role="button" data-bs-toggle="dropdown">
                            Administración
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="solicitud.php">Solicitudes Nuevas</a></li>
                            <li><a class="dropdown-item" href="docs.php">Documentos</a></li>
                            <li><a class="dropdown-item" href="bus.php">Búsqueda de Egresado</a></li>
                            <li><a class="dropdown-item" href="jefe.php"><i class="zmdi zmdi-book"></i> Listado de Egresados</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuarios" role="button" data-bs-toggle="dropdown">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="listaegre.php">Administración de usuarios</a></li>
                            <li><a class="dropdown-item" href="registroadmin.php">Agregar Administrador</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="a.php">Principal</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="container-fluid">
        <img src="images/Imagen1.png" alt="Banner" class="banner-img">
    </div>

    <!-- Formulario de Registro -->
    <form action="" method="post" autocomplete="off">
        <h2 class="text-center">Registro de Administrador</h2>
        <label for="nombre">Nombre(s)</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="nombre">Apellido Paterno</label>
        <input type="text" name="ap_p" id="ap_p" required>

        <label for="nombre">Apellido Materno</label>
        <input type="text" name="ap_m" id="ap_m" required>
        
        <label for="num_con">Número de Empleado</label>
        <input type="text" name="num_con" id="num_con" required>
        
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" required>
        
        <label for="contraseña">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña" required>
        
        <label for="confirmcontraseña">Confirmar Contraseña</label>
        <input type="password" name="confirmcontraseña" id="confirmcontraseña" required>
        
        <label for="rol">Rol</label>
<select name="rol" id="rol" required onchange="toggleCarreraSelect()">
    <option value="" disabled selected>Seleccione un rol</option>
    <option value="Administrador">Administrador</option>
    <option value="Jefe de carrera">Jefe de carrera</option>
</select>

<label for="carrera" id="labelCarrera" style="display: none;">Carrera</label>
<select id="carrera" name="carrera" class="form-select" style="display: none;" required>
    <option value="" disabled selected>Seleccione una carrera</option>
    <option value="Ingenieria en Electrónica">Ing. Electrónica</option>
    <option value="Ingenieria en Sistemas Computacionales">Ing. en Sistemas Computacionales</option>
    <option value="Ingenieria en Gestión Empresarial">Ing. en Gestión Empresarial</option>
    <option value="Ingeniería en TICS">Ingeniería en Tecnologías de la Información y Comunicaciones</option>
    <option value="Contador Público">Contador Público</option>
    <option value="Ingeniería en Industrial">Ing. Industrial</option>
    <option value="Ingeniería en Logística">Ing. en Logística</option>
    <option value="Ingeniería en Administración">Ing. en Administración</option>
    <option value="Ingeniería en Mecatrónica">Ing. Mecatrónica</option>
    <option value="Ingeniería en Química">Ing. Química</option>
</select>
        
        <input type="submit" name="submit" value="Registrar">
    </form>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleCarreraSelect() {
        const rol = document.getElementById('rol').value;
        const carreraLabel = document.getElementById('labelCarrera');
        const carreraSelect = document.getElementById('carrera');

        if (rol === "Jefe de carrera") {
            carreraLabel.style.display = "block"; // Mostrar el label de carrera
            carreraSelect.style.display = "block"; // Mostrar el select de carrera
            carreraSelect.setAttribute('required', 'true'); // Hacerlo obligatorio
        } else {
            carreraLabel.style.display = "none"; // Ocultar el label de carrera
            carreraSelect.style.display = "none"; // Ocultar el select de carrera
            carreraSelect.removeAttribute('required'); // Quitar el atributo "required"
        }
    }
</script>
</body>
</html>