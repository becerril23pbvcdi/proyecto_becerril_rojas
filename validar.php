<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password'])); // Encriptar para comparar
    
    // Consulta segura con prepared statements
    $sql = "SELECT id, nombre, email FROM alumnos WHERE email = ? AND password = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        
        // Crear sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_email'] = $usuario['email'];
        
        // Redireccionar al menú principal
        header("Location: menu_principal.html");
        exit();
    } else {
        echo "<script>
                alert('Credenciales incorrectas. Por favor, intente nuevamente.');
                window.location.href = 'index.html';
              </script>";
    }
    
    $stmt->close();
    $conexion->close();
}
?>