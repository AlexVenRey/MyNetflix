<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_genero = $_POST['id_genero'];
    $genero = $_POST['genero'];

    // Preparar la consulta SQL para actualizar el género
    $sqlUpdate = $conn->prepare('UPDATE genero SET nombre = :genero WHERE id_genero = :id_genero');
    $sqlUpdate->bindParam(':id_genero', $id_genero);
    $sqlUpdate->bindParam(':genero', $genero);

    // Ejecutar la consulta
    $sqlUpdate->execute();

    // Cerrar conexión
    $sqlUpdate->closeCursor();
    $conn = null;

    // Devolver respuesta en formato JSON
    echo json_encode(['success' => true]);
    exit();
}
?>
