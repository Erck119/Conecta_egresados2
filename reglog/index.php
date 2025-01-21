<?php
require 'config.php';
if (!empty($_SESSION['id'])) {
	$id = $_SESSION["id"];
	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);
} else {
	header("Location: registro.php");
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
