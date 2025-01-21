<?php
$nombreImagen = "images/membrete horizontal 2023_Mesa de trabajo 1.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>

<body>
	<head><center><img src="<?php echo $imagenBase64 ?>" alt="" width="100%" height="20%"></center></head>
	
	

</body>