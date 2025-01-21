<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Tabla de datos</title>
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
                            <i class="zmdi zmdi-case"></i> Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownAdministracion">
                            <li><a class="dropdown-item" href="solicitud.php"><i class="zmdi zmdi-balance"></i> Solicitudes Nuevas</a></li>
                            <li><a class="dropdown-item" href="docs.php"><i class="zmdi zmdi-labels"></i> Documentos</a></li>
                            <li><a class="dropdown-item" href="bus.php"><i class="zmdi zmdi-book"></i> Búsqueda de Egresado</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="zmdi zmdi-account-add"></i> Usuarios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownUsuarios">
                            <li><a class="dropdown-item" href="listaegre.php"><i class="zmdi zmdi-male-female"></i> Administración de usuarios</a></li>
                            <li><a class="dropdown-item" href="registroadmin.php"><i class="zmdi zmdi-male-female"></i> Agregar Administrador</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes.php"><i class="zmdi zmdi-chart"></i> Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="configuracion.php"><i class="zmdi zmdi-settings"></i> Configuración</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="a.php" title="Mis datos"><i class="zmdi zmdi-account-circle"></i>Principal </a>
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
    <?php
    // Verificar si el usuario ha iniciado sesión
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        // Si no ha iniciado sesión, redireccionar al inicio de sesión
        header("Location: login.php");
        exit;
    }
    ?>


  <h1><center>Búsqueda de Egresados<center></h1>
   

    <!-- Campo de búsqueda y botón de búsqueda -->

    <form method="get">
    <input type="submit" id="search" name="search" value="Buscar" style="background-color: #007BFF; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
        <!-- Botón Excel (enlace con clase de botón) -->
        <a href="./excelbus.php" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">
            Excel
        </a><br><br>
    <input type="text" id="search" name="search"value=>
    <div class="elem-group"> 
    </form> <br>

    <?php
    require 'config.php';

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener el valor del campo de búsqueda
    $search = $_GET['search'] ?? '';

    // Ejecutar la consulta SQL con el filtro de búsqueda
   $sql = "SELECT usuarios.nombre, datos.*
        FROM usuarios
        INNER JOIN datos ON usuarios.num_con = datos.num_con
        WHERE usuarios.nombre LIKE '%$search%'
        OR datos.ap_p LIKE '%$search%'
        OR datos.ap_m LIKE '%$search%'
        ORDER BY datos.fecha DESC";

$result = $conn->query($sql);

    // Mostrar los resultados en una tabla
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre(s)</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Número de Celular</th><th>Número de Celular Alternativo</th><th>Correo Electrónico</th><th>Correo Electrónico Alternativo</th><th>Cédula</th><th>Carrera</th><th>Año de Egreso</th><th>Fecha de Registro</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='text' value='" . $row["nombre"] . "' id='nombre" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["ap_p"] . "' id='ap_p" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["ap_m"] . "' id='ap_m_" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["tel_1"] . "' id='tel_1" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["tel_2"] . "' id='tel_2" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["email_1"] . "' id='email_1" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["email_2"] . "' id='email_2" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["cedula"] . "' id='cedula" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["carrera"] . "' id='carrera" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["ano_egre"] . "' id='ano_egre" . $row["id"] . "'></td>";
        echo "<td><input type='text' value='" . $row["fecha"] . "' id='fecha" . $row["id"] . "'></td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

    // Cerrar la conexión
    $conn->close();
    ?>
<?php

$conn = mysqli_connect("localhost", "root", "", "conecta_egresados");

?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Función para guardar los cambios
        function guardarCambios(id) {
        var ap_p = document.getElementById("ap_p_" + id).value;
        var ap_m = document.getElementById("ap_m_" + id).value;

        // Realizar una petición AJAX a un script PHP para guardar los cambios
        $.post("guardar_cambios_credencial.php", { id: id, ap_p: ap_p, ap_m: ap_m })
            .done(function(data) {
                alert(data); // Mostrar mensaje de éxito o error
            })
            .fail(function() {
                alert("Error al guardar los cambios.");
            });
    }

        // Función para eliminar un registro
        function eliminarRegistro(id) {
            // Realizar la petición AJAX
            $.ajax({
                url: 'eliminar_registro.php',
                type: 'POST',
                data: { registro_id: id },
                success: function(response) {
                    // La petición fue exitosa, se ejecuta este código
                    alert(response);
                },
                error: function() {
                    // Ocurrió un error en la petición AJAX
                    alert('Error al realizar la petición.');
                }
            });
        }
    </script>

<!DOCTYPE html>
<html>
<head>
  <title>Formulario de Datos de Egresados</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
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
    input[type="tel"],
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
    
    body {
            font-family: Arial, sans-serif;
			padding-top: 70px; /* Ajustar para el navbar fijo */
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
		body {
      		font-family: Arial, sans-serif;
      		background-color: #f2f2f2;
      		margin: 0;
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
  </style>
</head>

  </form>


</body>
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Footer -->
<footer class="text-center py-3">
        <p>&copy; 2024 Tecnológico de Estudios Superiores de Cuautitlán Izcalli</p>
    </footer>
</html>


