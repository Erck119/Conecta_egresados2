<!DOCTYPE html>
<html lang="es">
<head>
	<title>Admin</title>
	<center><img src="images/membrete horizontal 2023_Mesa de trabajo 1.png" alt="" width="90%" height="20%"></center>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>


	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title"><h2>
				ADMINISTRADOR <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					
       <img src="images/rino.png" alt="" width="25%" height="55%">

					<figcaption class="text-center text-titles"> </figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<h2><a href="a.php" title="Mis datos">


 


							<i class="zmdi zmdi-account-circle"></i>
						</a>
					</li>
					<li>
						
                    <h2><a href="login.php" title="Salir">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>

				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="dsb.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Panel de Control
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="solicitud.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Solicitudes Nuevas</a>
						</li>
						<li>
							<a href="docs.php"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Documentos</a>
						</li>
						<li>
							<a href="obser.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Observaciones</a>
							
						</li>

						<li>
							<a href="bus.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Busqueda de Egresado</a>
							
						</li>
						<li>
<a href="edi.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Editar Datos de Egresado </a>

						</li>
						<li>
<a href="elimi.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Eliminar Datos de Egresado</a>

						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
											
						<li>
							<a href="listaegre.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Egresados</a>
						</li>
						<li>
							<a href="registroadmin.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Administradores</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="catalog.html">
						<i class="zmdi zmdi-book-image zmdi-hc-fw"></i> Estadistica
					</a>
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
						<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>

				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header"><br><br><br><br>
			  <h2 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>ADMINISTRADORES</small></h2>
			</div>
		<p class="lead">Tecnológico de Estudios Superiores de Cuautitlán Izcalli</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
			  		


<!DOCTYPE html>
<html>
<head>
	

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
    input[type="password"],
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


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>a</title>
</head>
<body>


		<!-- Panel nuevo administrador -->
		<div class="container-fluid">
			<div class="panel panel-info">
				<div class="panel-heading">
					</div>
				<div class="panel-body">
					<form>
				    	<fieldset>
<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Extensión y Seguimiento de Egresados</legend>
		<div class="container-fluid">
		<div class="row">
		<div class="col-xs-12">
		<div class="form-group label-floating">	
    	</div>
		</div>
		
    <form  method="POST">
    <legend></i> &nbsp; Objetivo</legend>
     <label for="nombre">Realizar los programas de vinculación con los sectores de la sociedad para garantizar el cumplimiento de los programas de residencias profesionales y consolidar el desarrollo tecnológico de las y los estudiantes, egresadas y egresados, mediante la recomendación de las y los alumnos destacados ante instituciones de los sectores, públicos, social o privado relacionadas con el mercado laboral.</label>
    
		
<legend></i> &nbsp; Egresado y Egresada</legend>

     <label for="nombre">El TESCI ha formulado un programa de seguimiento a la comunidad egresada del Tecnológico con el propósito de valorar tu rendimiento como profesionista y atender necesidades de educación continua que fortalezcan tu crecimiento tanto profesional como personal.

 </label>
    


	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>


