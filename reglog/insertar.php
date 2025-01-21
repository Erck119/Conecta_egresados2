<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Inserción</title>
</head>
<body>
    <h1>Formulario de Inserción</h1>

   <form  method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="" required>

    <label for="cartatermino">carta de termino:</label>
    <input type="text" id="cartatermino" name="cartatermino" placeholder=""required>

    <label for="ingles">ingles:</label>
    <input type="text" id="ingles" name="ingles" placeholder=""required>
<input  class="btn" type="submit" name="register" value="Regresar" onclick="history.back()" /> </form>
<?php
include("insertar2.php");
?>
</body>
</html>