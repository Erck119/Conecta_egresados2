<?php
require 'config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $archivo = $_POST['archivo']; // Nombre del archivo
    $carpeta = $_POST['carpeta']; // Nombre de la carpeta (Número de control)

    $rutaArchivo = "C:/xampp/htdocs/conecta_egresados/documentos/$carpeta/$archivo";

    if (file_exists($rutaArchivo)) {
        // Intentar eliminar el archivo
        if (unlink($rutaArchivo)) {
            // Conectar a la base de datos y buscar a qué columna corresponde el archivo
            $sql = "SELECT * FROM documentos WHERE num_con = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $carpeta);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_assoc();
            $stmt->close();

            if ($fila) {
                $columna = null;

                // Determinar qué columna corresponde al archivo
                foreach (['carta_termino', 'boleta_o_ingles', 'titulo', 'foto'] as $campo) {
                    if (stripos($fila[$campo], $archivo) !== false) {
                        $columna = $campo;
                        break;
                    }
                }

                if ($columna) {
                    // Actualizar la columna correspondiente a NULL
                    $sqlUpdate = "UPDATE documentos SET $columna = NULL WHERE num_con = ?";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bind_param("s", $carpeta);
                    $stmtUpdate->execute();

                    if ($stmtUpdate->affected_rows > 0) {
                        // Redirigir a docs.php con éxito
                        header("Location: docs.php?success=Archivo eliminado y '$columna' actualizado a NULL");
                        exit;
                    } else {
                        // Redirigir a docs.php con error
                        header("Location: docs.php?error=No se pudo actualizar la base de datos");
                        exit;
                    }

                    $stmtUpdate->close();
                } else {
                    // Redirigir a docs.php con error
                    header("Location: docs.php?error=El archivo no coincide con ninguna columna");
                    exit;
                }
            } else {
                // Redirigir a docs.php con error
                header("Location: docs.php?error=No se encontró el número de control");
                exit;
            }
        } else {
            // Redirigir a docs.php con error
            header("Location: docs.php?error=No se pudo eliminar el archivo");
            exit;
        }
    } else {
        // Redirigir a docs.php con error
        header("Location: docs.php?error=El archivo no existe");
        exit;
    }
}
?>