<?php
require 'config.php';
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Realizamos la conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "conecta_egresados");

    // Verificamos si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para obtener los datos del usuario
    $ssql = "SELECT nombre, ap_p, ap_m, carrera, ano_egre, num_con FROM datos WHERE email_1 = '$email'";
    $result = $conn->query($ssql);

    // Verificamos si se encontraron datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Asignar datos de la base de datos a variables
        $nombre = $row['nombre'];
        $ap_p = $row['ap_p'];
        $ap_m = $row['ap_m'];
        $carrera = $row['carrera'];
        $ano_egre = $row['ano_egre'];
        $num_con = $row['num_con'];

        // Consultar la tabla foto para obtener la imagen asociada al num_con
        $ssql_foto = "SELECT contenido FROM foto WHERE titulo = '$num_con'";
        $result_foto = $conn->query($ssql_foto);

        if ($result_foto->num_rows > 0) {
            $row_foto = $result_foto->fetch_assoc();
            $imageData = $row_foto['contenido']; // Foto en formato binario

            // Procesar la imagen
            $base64Image = base64_encode($imageData);
            $filename = 'imagen_convertida.png';
            file_put_contents($filename, base64_decode($base64Image));
        } else {
            $filename = 'placeholder.png'; // Imagen por defecto si no existe la foto
        }
    } else {
        echo "<script>
            alert('No se encontraron datos para este usuario.');
            window.location.href = 'login.php';
        </script>";
        exit();
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
} else {
    echo "<script>
        alert('No se ha iniciado sesión.');
        window.location.href = 'login.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <center>
        <img src="images/membrete V 24.png" alt="" width="100%" height="100%">
        <br><img src="images/fra.png" alt="" width="100%" height="7%">
        <h3>TECNÓLOGICO DE ESTUDIOS SUPERIORES DE CUAUTITLÁN IZCALLI</h3>
    </center>
    <title>Información del Egresado</title>
    <style>
        .centered {
            text-align: center;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #FDFEFE;
            margin: 0;
            padding: 20px;
        }
        h1, h4 {
            text-align: center;
        }
        img {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="centered">
        <!-- Mostrar imagen de egresado -->
        <img src="<?php echo $filename; ?>" alt="Foto Egresado" width="30%" height="30%">

        <!-- Mostrar información del egresado -->
        <?php
            echo "<h4>Nombre(s) <br><br> $ap_p $ap_m $nombre</h4>";
            echo "<h4>Carrera <br><br> $carrera</h4>";
            echo "<h4>Número de Control <br><br> $num_con</h4>";
            echo "<h4>Año de Egreso <br><br> $ano_egre</h4>";
        ?>
    </div>

    <!-- Mostrar código QR y detalles -->
    <center>
        <img src="qr.png" alt="Código QR" width="10%" height="10%">
        <?php
            echo "<h4>ID: $num_con</h4>";
            echo "<h4>Vigencia Diciembre 2023</h4>";
        ?>
    </center>

    <img src="images/fra.png" alt="" width="100%" height="7%">
</body>
</html>
