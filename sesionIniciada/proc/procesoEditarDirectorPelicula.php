<?php
    include_once("../../conexion/conexion.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id_director_pelicula = $_POST['id_director_pelicula'];
        $id_director = $_POST['director'];
        $id_pelicula = $_POST['pelicula'];

        // Validaciones básicas
        if (empty($id_director) || empty($id_pelicula)) {
            echo json_encode(['success' => false, 'error' => 'Debe seleccionar un director y una película.']);
            exit();
        }

        // Verificar si la relación ya existe
        $sqlVerificar = $conn->prepare("SELECT id_director_pelicula FROM director_pelicula WHERE id_director = :id_director AND id_pelicula = :id_pelicula AND id_director_pelicula != :id_director_pelicula");
        $sqlVerificar->bindParam(':id_director', $id_director);
        $sqlVerificar->bindParam(':id_pelicula', $id_pelicula);
        $sqlVerificar->bindParam(':id_director_pelicula', $id_director_pelicula);
        $sqlVerificar->execute();

        if ($sqlVerificar->rowCount() > 0) {
            echo json_encode(['success' => false, 'error' => 'Esta relación ya existe en la base de datos.']);
            exit();
        }

        // Actualizar la relación en la BD
        $sqlUpdate = $conn->prepare("UPDATE director_pelicula SET id_director = :id_director, id_pelicula = :id_pelicula WHERE id_director_pelicula = :id_director_pelicula");
        $sqlUpdate->bindParam(':id_director_pelicula', $id_director_pelicula);
        $sqlUpdate->bindParam(':id_director', $id_director);
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