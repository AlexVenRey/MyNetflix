<?php
    include_once("../../conexion/conexion.php");

    $datos = json_decode(file_get_contents("php://input"), true);
    $usuarioId = $datos['usuarioId'];

    if (!$usuarioId) {
        echo json_encode(["error" => "Falta el ID del usuario"]);
        exit;
    }

    $sqlEstado = "SELECT estado FROM usuarios WHERE id_usuarios = :usuarioId";
    $stmtEstado = $conn->prepare($sqlEstado);
    $stmtEstado->bindParam(":usuarioId", $usuarioId);
    $stmtEstado->execute();
    $estado = $stmtEstado->fetchColumn();

    echo json_encode(["estado" => $estado]);
?>