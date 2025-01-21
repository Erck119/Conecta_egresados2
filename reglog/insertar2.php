<?php
include("config.php");
if(isset($_POST['register'])){
if (
    (strlen($_POST['nombre']) >= 1) &&
    (strlen($_POST['cartatermino']) >= 1) &&
    (strlen($_POST['ingles']) >= 1)
) {
        $nombre = trim($_POST['nombre']);
        $cartatermino = trim($_POST['cartatermino']);
        $ingles = trim($_POST['ingles']);
        $consulta = "INSERT INTO documento(nombre,cartatermino,ingles)
        VALUES('$nombre','$cartatermino', '$ingles')"; 
        $resultado = mysqli_query($conn, $consulta);
        if($resultado) {
            ?>
            <h3 class="success"     href="http://localhost/reglog/foto.php"
    title=""
           > Tu registro se ha completado</h3>
            <?php
        } else {
            ?>
            <h3 class="error"> Ocurrió un error</h3>
            <?php
        }
    }
}
?>