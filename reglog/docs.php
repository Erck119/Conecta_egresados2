<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentación</title>
</head>
<body>
    <img src="images/fra.png" alt="" width="100%" height="100%">
    <h1><center>Documentación</center></h1>
    <img src="images/fra.png" alt="" width="100%" height="100%">

    <!-- Campo de búsqueda y botón de búsqueda -->
    <form method="get">
        <input type="submit" id="search" name="search" value="Buscar"><br><br>
        <input type="text" id="search" name="search" value="">
        <div class="elem-group"> 
    </form> 

    <?php
    require 'config.php';

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener el valor del campo de búsqueda
    $search = $_GET['search'] ?? '';

    // Ejecutar la consulta SQL con el filtro de búsqueda
    $sql = "SELECT * FROM documento WHERE nombre LIKE '%$search%' OR cartatermino LIKE '%$search%' OR ingles LIKE '%$search%'";
    $result = $conn->query($sql);

    // Mostrar los resultados en una tabla
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Numero de Control</th><th>Carta de Termino de Residencias</th><th>Ingles</th><br>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            
            echo "<td><input type='text' value='" . $row["nombre"] . "' id='nombre_" . "'></td>";
            echo "<td><input type='text' value='" . $row["cartatermino"] . "' id='ingles" . "'></td>";
            echo "<td><input type='text' value='" . $row["ingles"] . "' id='ingles" . "'></td>";
            echo "<td>";
            
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }
    ?>






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



<center><input  class="btn" type="submit" name="register" value="Atras" a href="a.php" title="Mis datos" /></form>

 <a class="fcc-btn" href="a.php">Regresar a Página Principal</a>


    
</div>
</body>
</html>