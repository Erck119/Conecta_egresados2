<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>usuarios</title>
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



  <h1><center>Usuarios Registrados<center></h1>

    

       <!-- Campo de búsqueda y botón de búsqueda -->

    <form method="get">
    <input type="submit" id="search" name="search"value="Buscar">
    <a href="./excellistaegre.php" class="btn-small blue">Excel</a><br><br>
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
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%' OR num_con LIKE '%$search%' OR email LIKE '%$search%' OR rol LIKE '%$search%'";
    $result = $conn->query($sql);

    // Mostrar los resultados en una tabla
        if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Número de Control</th><th>Nombre(s)</th><th>Contraseña</th><th>Correo Electrónico</th><th>Usuario</th></tr>";

        while ($row = $result->fetch_assoc()) {
           echo "<tr>";
            echo "<td><input type='text' value='" . $row["num_con"] . "' id='num_con"  . "'></td>";
            echo "<td><input type='text' value='" . $row["nombre"] . "' id='nombre" . "'></td>";
            echo "<td><input type='text' value='" . $row["contrasena"] . "' id='contrasena"  . "'></td>";
            echo "<td><input type='text' value='" . $row["email"] . "' id='email" . "'></td>";
            echo "<td><input type='text' value='" . $row["rol"] . "' id='rol" .  "'></td>";
            
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

    <?php

$conn = mysqli_connect("localhost", "root", "", "conecta_egresados");

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Borrar registros de la base de datos</title>
</head>

<body>

<div>
  <h1>Borrar Registro</h1>
  <br>

  <?php
    // Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Recibimos los datos del formulario
      $num_con = $_POST["num_con"];

      // Realizamos la conexión a la base de datos
      $conn = new mysqli("localhost", "root", "", "conecta_egresados");

      // Verificamos si la conexión fue exitosa
      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      // Creamos la sentencia SQL
      $ssql = "DELETE FROM usuarios WHERE num_con='$num_con'";

      // Ejecutamos la sentencia de borrado
      if ($conn->query($ssql) === TRUE) {
        echo '<p>Contacto borrado con éxito</p>';
      } else {
        echo '<p>Hubo un error al borrar el contacto: ' . $conn->error . '</p>';
      }

      // Cerramos la conexión a la base de datos
      $conn->close();
    } else {
      // Realizamos la conexión a la base de datos
      $conn = new mysqli("localhost", "root", "", "conecta_egresados");

      // Verificamos si la conexión fue exitosa
      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      // Creamos la sentencia SQL y la ejecutamos
      $ssql = "SELECT num_con FROM usuarios";
      $result = $conn->query($ssql);

      // Verificamos si hay registros en la base de datos
      if ($result->num_rows > 0) {
        echo '<form method="POST" action="borrar.php">';
        echo 'Número de Control<br>';
        echo '<select name="num_con">';
        
        // Mostramos los registros en forma de menú desplegable
        while ($row = $result->fetch_assoc()) {
          echo '<option>' . $row["num_con"] . '</option>';
        }
        
        echo '</select><br>';
        echo '<input type="submit" value="Borrar">';
        echo '</form>';
      } else {
        echo '<p>No hay registros en la base de datos</p>';
      }

      // Liberamos los resultados y cerramos la conexión a la base de datos
      $result->free_result();
      $conn->close();
    }
  ?>

  
</div>

</body>
</html>

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