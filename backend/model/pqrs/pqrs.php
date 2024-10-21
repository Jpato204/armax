<?php

require_once("../../functions/database/conexion.php");





function crearSolicitud($id_user, $descripcion) {
    global $conn;

    // Preparar la consulta SQL
    $sql = "CALL insertar_solicitud(:id_user, :descripcion)";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();
}

