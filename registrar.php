<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Validar campos obligatorios
    $requiredFields = ['nombre', 'ap_p', 'ap_m', 'sexo', 'tel_1', 'email_1', 'carrera', 'ano_egre', 'num_con'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo '<script>alert("El campo ' . $field . ' es obligatorio.");</script>';
            exit;
        }
    }

    // Asignar valores de los campos
    $num_con = trim($_POST['num_con']);
    $nombre = trim($_POST['nombre']);
    $ap_p = trim($_POST['ap_p']);
    $ap_m = trim($_POST['ap_m']);
    $sexo = trim($_POST['sexo']);
    $tel_1 = trim($_POST['tel_1']);
    $tel_2 = isset($_POST['tel_2']) ? trim($_POST['tel_2']) : null;
    $email_1 = trim($_POST['email_1']);
    $carrera = trim($_POST['carrera']);
    $ano_egre = trim($_POST['ano_egre']);
    $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : null;
    $fecha = date("d/m/y");

    // Verificar si el num_con ya existe en la base de datos
    $checkQuery = "SELECT * FROM datos WHERE num_con = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param('s', $num_con);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        // Si ya existe, actualizar los datos
        $updateQuery = "UPDATE datos 
                        SET nombre = ?, ap_p = ?, ap_m = ?, sexo = ?, tel_1 = ?, tel_2 = ?, email_1 = ?, carrera = ?, ano_egre = ?, cedula = ?, fecha = ?
                        WHERE num_con = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param('ssssssssssss', $nombre, $ap_p, $ap_m, $sexo, $tel_1, $tel_2, $email_1, $carrera, $ano_egre, $cedula, $fecha, $num_con);

        if ($stmtUpdate->execute()) {
            // Mensaje de éxito
            echo '
                <div class="popup-message">
                    <p class="message-success">¡Datos actualizados correctamente!</p>
                </div>
                <style>
                    .popup-message {
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: #a62346;
                        color: white;
                        padding: 20px 40px;
                        border-radius: 10px;
                        text-align: center;
                        font-size: 18px;
                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                        z-index: 9999;
                    }
                    .popup-message p {
                        margin: 0;
                        font-weight: bold;
                    }
                </style>
                <script>
                    setTimeout(function() {
                        window.location.href = "egresados.php"; // Redirige a egresados.php
                    }, 3000); // Espera 3 segundos
                </script>
            ';
        } else {
            echo '<script>alert("Error al actualizar los datos: ' . $stmtUpdate->error . '");</script>';
        }

        $stmtUpdate->close();
    } else {
        // Si no existe, insertar los nuevos datos
        $insertQuery = "INSERT INTO datos (nombre, ap_p, ap_m, sexo, tel_1, tel_2, email_1, carrera, ano_egre, cedula, num_con, fecha)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->bind_param('ssssssssssss', $nombre, $ap_p, $ap_m, $sexo, $tel_1, $tel_2, $email_1, $carrera, $ano_egre, $cedula, $num_con, $fecha);

        if ($stmtInsert->execute()) {
            echo '
                <div class="popup-message">
                    <p class="message-success">¡Felicidades! Registro enviado exitosamente.</p>
                </div>
                <style>
                    .popup-message {
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: #a62346;
                        color: white;
                        padding: 20px 40px;
                        border-radius: 10px;
                        text-align: center;
                        font-size: 18px;
                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                        z-index: 9999;
                    }
                    .popup-message p {
                        margin: 0;
                        font-weight: bold;
                    }
                </style>
                <script>
                    setTimeout(function() {
                        window.location.href = "egresados.php"; // Redirige a egresados.php
                    }, 3000); // Espera 3 segundos
                </script>
            ';
        } else {
            echo '<script>alert("Error al enviar el registro: ' . $stmtInsert->error . '");</script>';
        }

        $stmtInsert->close();
    }

    $stmtCheck->close();
}

$conn->close();
?>
