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

    <h1>Tabla de datos</h1>

    <!-- Campo de búsqueda y botón de búsqueda -->
    <form method="get">
        <label for="search">Buscar:</label>
        <input type="text" id="search" name="search">
        <button type="submit">Buscar</button>
    </form>

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
        echo "<tr><th>ID</th><th>nombre</th><th>apellido_p</th><th>apellido_m</th><th>Acciones</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><input type='text' value='" . $row["nombre"] . "' id='nombre_" . $row["id"] . "'></td>";
            echo "<td><input type='text' value='" . $row["apellido_paterno"] . "' id='apellido_paterno_" . $row["id"] . "'></td>";
            echo "<td>";
            echo "<button onclick='guardarCambios(" . $row["id"] . ")'>Guardar</button>";
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

    <!-- Botón de cierre de sesión -->
    <form action="a.php" method="post">
        <button type="submit">Regresar</button>
    </form>
</body>
</html>