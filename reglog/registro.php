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
<body>
  <img src="images/fra.png" alt="" width="100%" height="100%">
  <h1><center>Formulario<center></h1>
   <h1><center>Datos de Egresados<center></h1>
<img src="images/fra.png" alt="" width="100%" height="100%">
  <form  method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" placeholder="" required>

    <label for="apellido_paterno">Apellido Paterno</label>
    <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder=""required>

    <label for="apellido_materno">Apellido Materno</label>
    <input type="text" id="apellido_materno" name="apellido_materno" placeholder=""required>

    <label for="contacto_celular">Contacto Celular</label>
    <input type="tel" id="contacto_celular" name="contacto_celular"placeholder="Telefono a 10 digitos" required>

    <label for="contacto_celular_alt">Contacto Celular (Alternativo)</label>
    <input type="tel" id="contacto_celular_alt" name="contacto_celular_alt" placeholder="Telefono a 10 digitos">

    <label for="correo_electronico">Correo Electrónico</label>
    <input type="email" id="correo_electronico" name="correo_electronico"placeholder="" required>

    <label for="correo_alternativo">Correo Alternativo</label>
    <input type="email" id="correo_alternativo" name="correo_alternativo"placeholder="Opcional">

    <label for="cedula">Cédula</label>
    <input type="text" id="cedula" name="cedula"placeholder="No. de cedula(Opcional)">

    <label for="carrera">Carrera</label>
    <select id="carrera" name="carrera" required>
      <option value="">Seleccionar Carrera</option>
      <option value="Ing_Electrónica">Ing. Electrónica</option>
      <option value="Ing_Informática">Ing. Informática</option>
      <option value="Lic_Informatica">Lic. Informatica </option>
	  <option value="Lic_Contador_Publico">Lic. Contador Publico</option>
	  <option value="Ing_Sistemas_Computacionales">Ing. en Sistemas Computacionales</option>
	  <option value="Ing_en_Gestión_Empresarial">Ing. en Gestión Empresarial</option>
	  <option value="Ingeniería_TICS">Ingeniería en Tecnologías de la Información y Comunicaciones</option>
	  <option value="Contador_Público">Contador Público</option>
	  <option value="Ing_Industrial">Ing. Industrial</option>
	  <option value="Ing_Logística">Ing. en Logística</option>
	  <option value="Ing_Administración">Ing. en Administración</option>
	  <option value="Ing_Mecatrónica">Ing. Mecatrónica</option>
	  <option value="Ing_Química">Ing. Química</option>
    </select>

    <label for="foto">Foto del Egresado</label>
    <input type="file" class="form-control-file" name="foto"> <br><br>



    <label for="año_egreso">Año de Egreso</label><center>
    <input type="text" id="año_egreso" name="año_egreso">

    <input  class="btn" type="submit" name="register" value="Enviar">

    <input  class="btn" type="submit" name="register" value="Descargar Credencial">

   <input  class="btn" type="submit" name="register" value="Corroborar Datos" onclick="history.back()" /> 

<a class="fcc-btn" href="login.php">Salir</a><center>



 </form>
  </form>


   


  <?php
include("registrar.php");
?>
</body>
</html>
