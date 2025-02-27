<?php

    include_once("../../conexion/conexion.php");

    // Obtener los datos enviados por POST
    $datos = json_decode(file_get_contents("php://input"), true);
    $usuarioId = $datos['usuarioId'];

    if (!$usuarioId) {
        echo json_encode(["error" => "Falta el ID del usuario"]);
        exit;
    }

    // Obtener el estado actual del usuario
    $sqlActivarEstado = "SELECT estado FROM usuarios WHERE id_usuarios = :usuarioId";
    $stmtActivarEstado = $conn->prepare($sqlActivarEstado);
    $stmtActivarEstado->bindParam(":usuarioId", $usuarioId);
    $stmtActivarEstado->execute();
    $estadoActual = $stmtActivarEstado->fetchColumn();

    $nuevoEstado = '';

    if ($estadoActual === 'desactivado' || $estadoActual === 'registrado') {

        $nuevoEstado = 'activado';

    } else if ($estadoActual === 'activado') {

        $nuevoEstado = 'desactivado';

    }

    // Actualizar el estado en la base de datos
    $sqlActualizarEstado = "UPDATE usuarios SET estado = :nuevoEstado WHERE id_usuarios = :usuarioId";
    $stmtActualizarEstado = $conn->prepare($sqlActualizarEstado);
    $stmtActualizarEstado->bindParam(":nuevoEstado", $nuevoEstado);
    $stmtActualizarEstado->bindParam(":usuarioId", $usuarioId);
    $stmtActualizarEstado->execute();

    // Devolver el nuevo estado al frontend
    echo json_encode(["mensaje" => "Estado actualizado", "nuevoEstado" => $nuevoEstado]);
?>
