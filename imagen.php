<?php
require 'config.php';
session_start();
if(isset($_SESSION['fotoegre'])){
    $imageData=$_SESSION['fotoegre'];
    header("Content-type: image/png");
    echo $_SESSION['fotoegre'] ;

}
?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
   <img src="extraer imagen.php">
</body>
</html>
