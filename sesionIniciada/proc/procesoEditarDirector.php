<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_director = $_POST['id_director'];
    $director = $_POST['director'];

    // Preparar la consulta SQL para actualizar el director
    $sqlUpdate = $conn->prepare("UPDATE directores SET nombre_director = :director WHERE id_director = :id_director");
    $sqlUpdate->bindParam(':id_director', $id_director);
    $sqlUpdate->bindParam(':director', $director);

    if ($sqlUpdate->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al actualizar el director.']);
    }
    $sqlUpdate->closeCursor();
    $conn = null;
    exit();
}
?>