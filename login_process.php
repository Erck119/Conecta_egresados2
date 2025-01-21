<?php
require 'config.php';
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitizar entrada
    $contrasena = $_POST['password'];

    // Consulta para verificar si existe el usuario
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verificamos la contraseña
        if (password_verify($contrasena, $user['contrasena'])) {
            // Contraseña correcta, inicia sesión
            $_SESSION['num_con'] = $user['num_con'];
            $_SESSION['rol'] = $user['rol'];

            if ($user['rol'] === 'Egresado') {
                header('Location: egresados.php');
                exit();
            } elseif ($user['rol'] === 'Administrador') {
                header('Location: a.php');
                exit();
            } elseif($user['rol'] === 'Jefe de carrera') {
                header('Location: jefedecarrera.php');
                exit();
            }
        } else {
            echo "<script>
                alert('Contraseña incorrecta');
                window.location.href='login.php';
            </script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>
            alert('Usuario no encontrado');
            window.location.href='login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Por favor completa todos los campos');
        window.location.href='login.php';
    </script>";
}
?>
