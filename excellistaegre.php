<?php

require_once ("dbconnect.inc.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
?>


<table class="table table-striped table-dark " id= "table_id">

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                   
<thead>    
<tr>
<th>Número de Control </th>
<th>Nombre(s)</th>
<th>Contraseña</th>
<th>Usuario/Administración</th>
<th>Correo Electrónico</th>



</tr>
</thead>
<tbody>

<?php

$conexion=mysqli_connect("localhost","root","","conecta_egresados");               
$SQL="SELECT user.num_con, user.nombre, user.contrasena, user.rol, user.email,
  FROM user
LEFT JOIN permisos ON user.rol = permisos.id";
$dato = mysqli_query($conexion, "SELECT * FROM usuarios");

if($dato -> num_rows >0){
while($fila=mysqli_fetch_array($dato)){

?>
<tr>
<td><?php echo $fila['num_con']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['contrasena']; ?></td>
<td><?php echo $fila['rol']; ?></td>
<td><?php echo $fila['email']; ?></td>


<?php
}

}




 