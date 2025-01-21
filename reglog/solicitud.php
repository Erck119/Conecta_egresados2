<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tabla de datos</title>
</head>
<body>
    <?php
    // Verificar si el usuario ha iniciado sesión
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        // Si no ha iniciado sesión, redireccionar al inicio de sesión
        header("Location: login.php");
        exit;
    }
    ?>
<img src="images/fra.png" alt="" width="100%" height="100%">
  <h1><center>Solicitudes<center></h1>
<img src="images/fra.png" alt="" width="100%" height="100%">
    

    <!-- Campo de búsqueda y botón de búsqueda -->

    <form method="get">
    <input type="submit" id="search" name="search"value="Buscar"><br><br>
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
    $sql = "SELECT * FROM datos WHERE nombre LIKE '%$search%' OR apellido_paterno LIKE '%$search%' OR apellido_materno LIKE '%$search%'";
    $result = $conn->query($sql);

    // Mostrar los resultados en una tabla
        if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Núm.</th><th>Nombre</th><th>Paterno</th><th>Materno</th><th>contacto_celular</th><th>contacto_celular_alt</th><th>correo_electronico</th><th>correo_alternativo</th><th>cedula</th><th>carrera</th><th>año de egreso</th><th>fecha de registro</th></tr>";

        while ($row = $result->fetch_assoc()) {
           echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><input type='text' value='" . $row["nombre"] . "' id='nombre_" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["apellido_paterno"] . "' id='apellido_paterno_" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["apellido_materno"] . "' id='apellido_materno_" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["contacto_celular"] . "' id='contacto_celular" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["contacto_celular_alt"] . "' id='contacto_celular_alt" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["correo_electronico"] . "' id='correo_electronico" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["correo_alternativo"] . "' id='correo_alternativo" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["cedula"] . "' id='cedula" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["carrera"] . "' id='carrera" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["año_egreso"] . "' id='año_egreso" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["fecha"] . "' id='fecha" . $row["id"] . "'></td>";
            echo "<td>";
            echo "<button onclick='guardarCambios(" . $row["id"] . ")'>Aceptar</button>";
            echo "<button onclick='eliminarRegistro(" . $row["id"] . ")'>Eliminar</button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Función para guardar los cambios
        function guardarCambios(id) {
            var nombre = document.getElementById("nombre_" + id).value;
            var apellido = document.getElementById("apellido_paterno_" + id).value;

            // Realizar una petición AJAX a un script PHP para guardar los cambios
            $.post("guardar_cambios.php", { id: id, nombre: nombre, apellido: apellido })
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
  </style>
</head>



<center><input  class="btn" type="submit" name="register" value="Atras" a href="a.php" title="Mis datos" /> </form>



 <a class="fcc-btn" href="a.php">Regresar a Página Principal</a><center>


  </form>


</body>
</html>