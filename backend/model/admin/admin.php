<?php

require_once("../../functions/database/conexion.php");
// Ejemplo de uso


function crearAdministrador($cedula, $nombre, $correo, $contrasena) {
    global $conn;

    // Preparar la consulta SQL
    $sql = "CALL ingresar_administrador(:cedula, :nombre, :correo, :contrasena)";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros
    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();
}
function actualizarpqrs($id, $nuevosDatos) {
    global $conn;

    // Suponiendo que también se utiliza para actualizar administradores, pero ajustando los parámetros
    $sql = "CALL Actualizar_pqr(:id, :admin, :description, :estado, :tratamiento)";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':admin', $nuevosDatos['admin'], PDO::PARAM_INT); // Ajusta según la estructura de $nuevosDatos
    $stmt->bindParam(':description', $nuevosDatos['description'], PDO::PARAM_STR);
    $stmt->bindParam(':estado', $nuevosDatos['estado'], PDO::PARAM_INT);
    $stmt->bindParam(':tratamiento', $nuevosDatos['tratamiento'], PDO::PARAM_STR);

    $stmt->execute();
}

