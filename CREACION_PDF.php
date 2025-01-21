
<?php
ob_start();
require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tabla de datos</title>
</head>
<body>
<center><img src="http://<?php  $_SERVER?> images/membrete horizontal 2023_Mesa de trabajo 1.png" alt="" width="90%" height="20%"></center>

  <h1><center>credencial<center></h1>
</body>
</html>
<?php
$html= ob_get_clean();
require_once'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf=new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf",array ("Attachment"=>false));




?>

