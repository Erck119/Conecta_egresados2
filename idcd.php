<!DOCTYPE html>
<html>
<head>
  <title>Introducir ID</title>
</head>
<body>
  <h1>Introducir ID</h1>
  <label for="idInput">ID:</label>
  <input type="text" id="idInput">
  <button onclick="mostrarID()">Mostrar ID</button>
  <p id="resultado"></p>

  <script>
    function mostrarID() {
      const id = document.getElementById("idInput").value;
      document.getElementById("resultado").innerText = "El ID introducido es: " + id;
    }
  </script>
</body>
</html>
