<?php
require 'config.php';
session_start();

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
} else {
    $nombre = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión y Registro</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('images/Diseño mascota - Final_Mesa de trabajo 1.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .membrete {
            text-align: center;
            margin: 20px 0;
        }
        .auth-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 500px;
            width: 100%;
            margin-top: 20px;
        }
        .form-switch-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #800020; /* Guinda */
        }
        .form-switch-container button {
            flex: 1;
            padding: 10px;
            border: none;
            background: none;
            color: #800020; /* Guinda */
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.3s ease, background-color 0.3s ease;
        }
        .form-switch-container button.active {
            color: #fff;
            background: #800020; /* Guinda */
        }
        form {
            display: none;
        }
        form.active {
            display: block;
        }
        .manual-link {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Membrete -->
    <div class="membrete">
        <img src="images/membrete2024.1.png" alt="Membrete" width="90%" height="auto">
    </div>

    <!-- Contenedor del Formulario -->
    <div class="auth-container">
        <!-- Navegación entre formularios -->
        <div class="form-switch-container">
            <button class="active" id="loginBtn">Inicio de Sesión</button>
            <button id="registerBtn">Registro</button>
        </div>

        <!-- Formulario de Iniciar Sesión -->
        <form id="loginForm" method="POST" action="login_process.php" class="active">
            <label for="email">Correo Institucional</label>
            <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Ingresa tu correo" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Ingresa tu contraseña" required>

            <button type="submit" name="login" class="btn btn-primary w-100" style="background-color: #800020; border-color: #800020;">Iniciar Sesión</button>
        </form>

        <!-- Formulario de Registro -->
        <form id="registerForm" method="POST" action="registraregresado.php">
    <label for="num_con">Número de Control</label>
    <input type="text" id="num_con" name="num_con" class="form-control mb-3" placeholder="Ingresa tu número de control" required>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" class="form-control mb-3" placeholder="Ingresa tu nombre" required>

    <label for="ap_p">Apellido Paterno</label>
    <input type="text" id="ap_p" name="ap_p" class="form-control mb-3" placeholder="Ingresa tu apellido paterno" required>

    <label for="ap_m">Apellido Materno</label>
    <input type="text" id="ap_m" name="ap_m" class="form-control mb-3" placeholder="Ingresa tu apellido materno" required>

    <label for="email_1">Correo Institucional</label>
    <input type="email" id="email_1" name="email_1" class="form-control mb-3" placeholder="Ingresa tu correo institucional" required>

    <label for="sexo">Género</label>
    <select id="sexo" name="sexo" class="form-control mb-3" required>
        <option value="" disabled selected>Selecciona tu sexo</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Crea una contraseña" required>

    <label for="carrera" class="form-label">Carrera</label>
    <select id="carrera" name="carrera" class="form-select" >
    <option value="" disabled selected>Seleccione una carrera</option>
    <option value="Ingenieria en Electrónica">Ing. Electrónica</option>
    <option value="Ingenieria en Sistemas Computacionales">Ing. en Sistemas Computacionales</option>
    <option value="Ingenieria en Gestión Empresarial">Ing. en Gestión Empresarial</option>
    <option value="Ingeniería en TICS">Ingeniería en Tecnologías de la Información y Comunicaciones</option>
    <option value="Contador Público">Contador Público</option>
    <option value="Ingeniería en Industrial">Ing. Industrial</option>
    <option value="Ingeniería en Logística">Ing. en Logística</option>
    <option value="Ingeniería en Administración">Ing. en Administración</option>
    <option value="Ingeniería en Mecatrónica">Ing. Mecatrónica</option>
    <option value="Ingeniería en Química">Ing. Química</option>
          </select>

    <button type="submit" name="register" class="btn btn-primary w-100" style="background-color: #800020; border-color: #800020;">Registrarse</button>
</form>


        <!-- Enlace al Manual -->
        <div class="manual-link">
            <a href="manual_usuario.pdf" target="_blank">¿Necesitas ayuda? Consulta el manual</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const loginBtn = document.getElementById('loginBtn');
        const registerBtn = document.getElementById('registerBtn');

        loginBtn.addEventListener('click', () => {
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
            loginBtn.classList.add('active');
            registerBtn.classList.remove('active');
        });

        registerBtn.addEventListener('click', () => {
            registerForm.classList.add('active');
            loginForm.classList.remove('active');
            registerBtn.classList.add('active');
            loginBtn.classList.remove('active');
        });
    </script>
</body>
</html>
