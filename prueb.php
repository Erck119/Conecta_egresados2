
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="usernameemail">Usuario o Email:</label>
        <input type="text" name="usernameemail" id="usernameemail" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>

<?php
session_start();
require 'config.php';

// Verificar si el formulario de inicio de sesión ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["usernameemail"])) {
        $usernameemail = $_POST["usernameemail"];
    }
    $contrasena = $_POST["contrasena"];
     $rol = $row["rol"]; // Obtiene el rol del usuario


    // Consultar el nombre del usuario en la base de datos
    $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE num_con = '$usernameemail' OR email = '$usernameemail'");

    if ($result->num_rows == 1) {
        // Las credenciales son válidas, iniciar sesión y redirigir al usuario a la página principal
        $row = $result->fetch_assoc();
        $_SESSION['num_con'] = $usernameemail;
        $_SESSION['nombre'] = $row['nombre'];
        header("Location: registro.php");
        exit();
    } else {
        // Las credenciales no son válidas, mostrar un mensaje de error
        $error = "Credenciales inválidas. Por favor, inténtalo de nuevo.";
    }

    $conn->close();
}
?>
