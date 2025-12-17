<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $opinion = trim($_POST['opinion']);
    $tema = isset($_POST['tema']) ? trim($_POST['tema']) : '';
    
    if (strlen($opinion) > 1000) {
        echo "<script>
                alert('La opinión no debe exceder 1000 caracteres.');
                window.history.back();
              </script>";
        exit();
    }
    
    // Insertar en base de datos
    $sql = "INSERT INTO opiniones (email, opinion) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $opinion);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('¡Gracias por tu opinión! Ha sido guardada exitosamente.');
                window.location.href = 'opiniones.html';
              </script>";
    } else {
        echo "<script>
                alert('Error al guardar la opinión: " . $stmt->error . "');
                window.history.back();
              </script>";
    }
    
    $stmt->close();
    $conexion->close();
}
?>