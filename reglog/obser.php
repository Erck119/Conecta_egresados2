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

<img src="images/fra.png" alt="" width="100%" height="100%">
  <h1><center>Observaciones<center></h1>
<img src="images/fra.png" alt="" width="100%" height="100%">


<form action="contact.php" method="post"> 
  <div class="elem-group"> 
    <label for="name">Nombre</label> 
    <input type="text" id="name" name="visitor_name" pattern=[A-Z\sa-z]{3,20} required> </div> 
  <div class="elem-group"> 
    <label for="email">Correo electrónico</label> 
    <input type="email" id="email" name="visitor_email"  required> </div> 
    <div class="elem-group"> 

        <div class="elem-group"> 
        <label for="title">Motivo de contacto</label> 
        <input type="text" id="title" name="email_title" required placeholder="Problema/Consulta" pattern=[A-Za-z0-9\s]{8,60}> </div> 
        <div class="elem-group"> 
        
 <label for="title">Solicitud</label> 

<textarea id="message" class="input" name="message" rows="10" cols="135"placeholder="Escribe tu mensaje aquí."></textarea><br />
    <span id="message_validation" class="error_message"></span>
  </div><br>
 


 <center><input id="submit_button" type="submit" value="Enviar Mensaje" />

  <input  class="btn" type="submit" name="register" value="Atras" onclick="history.back()" />

 <a class="fcc-btn" href="a.php">Regresar a Página Principal</a>




  </form>
</form>


