<?php

require_once("../../functions/database/conexion.php");


function crearUsuario($cedula, $nombre, $correo, $contrasena) {
    global $conn;

    // Preparar la consulta SQL
    $sql = "CALL ingresar_usuario(:cedula, :nombre, :correo, :contrasena)";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros
    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    // Aquí es crucial hashear la contraseña antes de insertarla
    $contrasenaHasheada = password_hash($contrasena, PASSWORD_DEFAULT);
    $stmt->bindParam(':contrasena', $contrasenaHasheada, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();
}