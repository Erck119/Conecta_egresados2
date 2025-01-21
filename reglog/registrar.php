<?php
include("config.php");
if(isset($_POST['register'])){
	if(
	(strlen($_POST['nombre']) >= 1) &&
	(strlen($_POST['apellido_paterno']) >= 1) &&
	(strlen($_POST['apellido_materno']) >= 1) &&
	(strlen($_POST['contacto_celular']) >= 1) &&
	
	(strlen($_POST['correo_electronico']) >= 1) &&
	
	
	(strlen($_POST['carrera']) >= 1) &&
	(strlen($_POST['año_egreso']) >= 1) 
	) {
		$nombre = trim($_POST['nombre']);
		$apellido_paterno = trim($_POST['apellido_paterno']);
		$apellido_materno = trim($_POST['apellido_materno']);
		$contacto_celular = trim($_POST['contacto_celular']);
		$contacto_celular_alt = trim($_POST['contacto_celular_alt']);
		$correo_electronico = trim($_POST['correo_electronico']);
		$correo_alternativo = trim($_POST['correo_alternativo']);
		$cedula = trim($_POST['cedula']);
		$carrera = trim($_POST['carrera']);
		$año_egreso= trim($_POST['año_egreso']);
		$fecha = date("d/m/y");
		$consulta = "INSERT INTO datos(nombre,apellido_paterno,apellido_materno,contacto_celular,contacto_celular_alt,correo_electronico,correo_alternativo,cedula,carrera,año_egreso,fecha)
		VALUES('$nombre','$apellido_paterno', '$apellido_materno', '$contacto_celular', '$contacto_celular_alt', '$correo_electronico', '$correo_alternativo', '$cedula','$carrera','$año_egreso', '$fecha')"; 
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

