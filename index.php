<?php
require 'config.php';
session_start();
if (!empty($_SESSION['num_con'])) {
	$id = $_SESSION["num_con"];
	$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE username = $id");
	$row = mysqli_fetch_assoc($result);
} else {
	header("Location: egresados.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
</head>
<body>
	<h1>Welcome <?php echo $row["name"]; ?></h1>
	<a href="logout.php">Logout</a>
</body>
</html>
