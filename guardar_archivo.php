<?php
require("dbconnect.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha subido un archivo
    if (isset($_FILES['archivito'])) {
        $archivo = $_FILES['archivito']['tmp_name'];
        $tamanio = $_FILES['archivito']['size'];
        $tipo    = $_FILES['archivito']['type'];
        $nom_doc  = $_FILES['archivito']['name'];
        $titulo  = $_POST['titulo'];

        if ($archivo != "none") {
            $contenido = file_get_contents($archivo);
            $contenido = addslashes($contenido);

            // Insertar el archivo en la base de datos
            $query = "INSERT INTO documentos (nom_doc, titulo, contenido, tipo) VALUES ('$nom_doc', '$titulo', '$contenido', '$tipo')";
            $resultado = mysqli_query($conn, $query);
            if ($resultado) {
                // Mensaje de éxito con estilo CSS centrado
                echo "<style>
                        .alert-container {
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background-color: #a62346;
                            color: white;
                            padding: 15px 30px;
                            border-radius: 5px;
                            font-size: 16px;
                            text-align: center;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                            z-index: 9999;
                            width: auto;
                            animation: fadeInOut 3s forwards;
                        }

                        @keyframes fadeInOut {
                            0% {
                                opacity: 0;
                            }
                            20% {
                                opacity: 1;
                            }
                            80% {
                                opacity: 1;
                            }
                            100% {
                                opacity: 0;
                            }
                        }
                      </style>
                      <div class='alert-container'>
                        Archivo agregado exitosamente.
                      </div>";
                
                // Redirigir a subdocs.php en la misma ventana después de 3 segundos
                echo "<script>
                        setTimeout(function() {
                            window.location.replace('subdocs.php'); // Redirige en la misma ventana sin abrir una nueva
                        }, 3000); // Redirigir después de 3 segundos
                      </script>";
            } else {
                echo "No se ha podido guardar el archivo en la base de datos: " . mysqli_error($conn);
            }
        } else {
            echo "No se ha podido subir el archivo al servidor.";
        }
    }
}

mysqli_close($conn);
?>
