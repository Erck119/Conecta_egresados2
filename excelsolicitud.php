<?php

require_once ("dbconnect.inc.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
?>


<table class="table table-striped table-dark " id= "table_id">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                   
<thead>    
<tr>
<th>id</th>
<th>Nombre(s)</th>
<th>Apellido Paterno</th>
<th>Apellido Materno</th>
<th>Número de Celular</th>
<th>Número de Celular Alternativo</th>
<th>Correo Electrónico</th>
<th>Correo Electrónico Alternativo</th>
<th>Carrera</th>
<th>Año de Egreso</th>
<th>Cédula</th>
<th>Número de Control</th>
<th>Estado</th>
<th>Fecha de Registro</th>
 


</tr>
</thead>
<tbody>

<?php

$conexion=mysqli_connect("localhost","root","","conecta_egresados");               
$SQL = "SELECT usuarios.nombre, datos.* FROM usuarios INNER JOIN datos ON usuarios.num_con = datos.num_con;";
$dato = mysqli_query($conexion, $SQL);




if($dato -> num_rows >0){
while($fila=mysqli_fetch_array($dato)){

?>
<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['ap_p']; ?></td>
<td><?php echo $fila['ap_m']; ?></td>
<td><?php echo $fila['tel_1']; ?></td>
<td><?php echo $fila['tel_2']; ?></td>
<td><?php echo $fila['email_1']; ?></td>
<td><?php echo $fila['email_2']; ?></td>
<td><?php echo $fila['carrera']; ?></td>
<td><?php echo $fila['ano_egre']; ?></td>
<td><?php echo $fila['cedula']; ?></td>
<td><?php echo $fila['num_con']; ?></td>
<td><?php echo $fila['estado']; ?></td>
<td><?php echo $fila['fecha']; ?></td>


<?php
}

}




 