<?php
// Conexión a la base de datos (suponiendo que tienes una función 'conectar()')
require_once("../../functions/database/conexion.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Primero, verificar si existe en la tabla de admins
    $sql = "SELECT * FROM admin WHERE correro = :correo";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        // Consider logging the error for further analysis
        error_log("Error al ejecutar la consulta: " . $e->getMessage());
    }
    

    // Si no es admin, verificar si es usuario
    if (!$admin) {
        $sql = "SELECT * FROM usuario WHERE correro = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar credenciales y redirigir
    if ($admin) {
        // Verificar contraseña del admin
        if (password_verify($contrasena, $admin['contraseña'])) {
            // Iniciar sesión como admin
            session_start();
            $_SESSION['usuario_id'] = $admin['id_admin']; // Utilizar id_admin para admin
            $_SESSION['rol'] = 'admin';
            header('Location: dashboard_admin.php');
            exit();
        }
    } elseif ($usuario) {
        // Verificar contraseña del usuario
        if (password_verify($contrasena, $usuario['contraseña'])) {
            // Iniciar sesión como usuario
            session_start();
            $_SESSION['usuario_id'] = $usuario['id_user']; // Utilizar id_user para usuario
            $_SESSION['rol'] = 'user';
            header('Location: dashboard_usuario.php');
            exit();
        }
    } else {
        // Mostrar mensaje de error
        echo "Correo o contraseña incorrectos.";
    }
}