<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_actor = $_POST['id_actor'];
    $actor = $_POST['actor'];

    // Preparar la consulta SQL para actualizar el actor
    $sqlUpdate = $conn->prepare("UPDATE actores SET nombre_actor = :actor WHERE id_actor = :id_actor");
    $sqlUpdate->bindParam(':id_actor', $id_actor);
    $sqlUpdate->bindParam(':actor', $actor);

    if ($sqlUpdate->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al actualizar el actor.']);
    }
    $sqlUpdate->closeCursor();
    $conn = null;
    exit();
}
?>