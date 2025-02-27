<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_actor_pelicula = $_POST['id_actor_pelicula'];
    $id_actor = $_POST['actor'];
    $id_pelicula = $_POST['pelicula'];

    // Validaciones básicas
    if (empty($id_actor) || empty($id_pelicula)) {
        echo json_encode(['success' => false, 'error' => 'Debe seleccionar un actor y una película.']);
        exit();
    }

    // Verificar si la relación ya existe
    $sqlVerificar = $conn->prepare("SELECT id_actor_pelicula FROM actor_pelicula WHERE id_actor = :id_actor AND id_pelicula = :id_pelicula AND id_actor_pelicula != :id_actor_pelicula");
    $sqlVerificar->bindParam(':id_actor', $id_actor);
    $sqlVerificar->bindParam(':id_pelicula', $id_pelicula);
    $sqlVerificar->bindParam(':id_actor_pelicula', $id_actor_pelicula);
    $sqlVerificar->execute();

    if ($sqlVerificar->rowCount() > 0) {
        echo json_encode(['success' => false, 'error' => 'Esta relación ya existe en la base de datos.']);
        exit();
    }

    // Actualizar la relación en la BD
    $sqlUpdate = $conn->prepare("UPDATE actor_pelicula SET id_actor = :id_actor, id_pelicula = :id_pelicula WHERE id_actor_pelicula = :id_actor_pelicula");
    $sqlUpdate->bindParam(':id_actor_pelicula', $id_actor_pelicula);
    $sqlUpdate->bindParam(':id_actor', $id_actor);
    $sqlUpdate->bindParam(':id_pelicula', $id_pelicula);

    if ($sqlUpdate->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al actualizar la relación.']);
    }
    $sqlUpdate->closeCursor();
    $conn = null;
    exit();
}
?>