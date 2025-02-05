<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturamos los datos enviados desde el formulario
    $num_con = $_POST['num_con'];
    $nombre = $_POST['nombre'];
    $ap_p = $_POST['ap_p'];
    $ap_m = $_POST['ap_m'];
    $email = $_POST['email_1'];
    $sexo = $_POST['sexo']; // Capturamos el valor del campo "sexo"
    $contraseña = $_POST['password'];
    $rol = 'Egresado'; // Asignamos el rol 'egre' automáticamente

    // Verificamos si el número de control o el correo ya están registrados
    $duplicate = mysqli_query($conn, "SELECT * FROM usuarios WHERE num_con = '$num_con' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('El número de control o el correo ya están registrados');</script>";
    } else {
        // Encriptamos la contraseña antes de guardarla
        $hashedPassword = password_hash($contraseña, PASSWORD_BCRYPT); // Aseguramos el uso de BCRYPT

        // Insertamos los datos en la tabla usuarios
        $queryUsuarios = "INSERT INTO usuarios (num_con, nombre, ap_p, ap_m, contrasena, rol, email) 
                          VALUES ('$num_con', '$nombre', '$ap_p', '$ap_m', '$hashedPassword', '$rol', '$email')";

        if (mysqli_query($conn, $queryUsuarios)) {
            // Si se insertaron los datos en usuarios correctamente, hacemos el insert en datos
            $queryDatos = "INSERT INTO datos (num_con, nombre, ap_p, ap_m, sexo, email_1) 
                           VALUES ('$num_con', '$nombre', '$ap_p', '$ap_m', '$sexo', '$email')";
            if (mysqli_query($conn, $queryDatos)) {
                echo "<script>alert('Registro exitoso'); window.location.href='login.php';</script>";
            } else {
                // Si falla el insert en datos, eliminar el registro en usuarios para evitar inconsistencias
                mysqli_query($conn, "DELETE FROM usuarios WHERE num_con = '$num_con'");
                echo "<script>alert('Error al registrar en la tabla datos. Intenta nuevamente');</script>";
            }
        } else {
            echo "<script>alert('Error al registrar en la tabla usuarios. Intenta nuevamente');</script>";
        }
    }
}
?>
