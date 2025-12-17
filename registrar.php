<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar datos
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password'])); // Encriptar
    $matricula = trim($_POST['matricula']);
    $semestre = intval($_POST['semestre']);
    $telefono = trim($_POST['telefono']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = trim($_POST['direccion']);
    $ciudad = trim($_POST['ciudad']);
    $interes = trim($_POST['interes']);
    
    // Insertar nuevo alumno
    $sql = "INSERT INTO alumnos (nombre, apellido, email, password, matricula, semestre, 
            telefono, fecha_nacimiento, direccion, ciudad) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssissss", $nombre, $apellido, $email, $password, 
                     $matricula, $semestre, $telefono, $fecha_nacimiento, 
                     $direccion, $ciudad);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Registro exitoso. Ahora puede iniciar sesión.');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "<script>
                alert('Error en el registro: " . $stmt->error . "');
                window.location.href = 'registro.html';
              </script>";
    }
    
    $stmt->close();
    $conexion->close();
}
?>