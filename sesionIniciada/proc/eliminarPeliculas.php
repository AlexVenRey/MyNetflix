<?php

    include_once('../../conexion/conexion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $datos = json_decode(file_get_contents("php://input"), true);

        if (isset($datos['id_pelicula'])) {

            $id_pelicula = $datos['id_pelicula'];

            $eliminarPelicula = $conn->prepare("DELETE FROM peliculas WHERE id_pelicula = :id_pelicula");
            $eliminarPelicula->bindParam(':id_pelicula', $id_pelicula);

            if ($eliminarPelicula->execute()) {

                echo json_encode(['success' => true]);

            } else {

                echo json_encode(['success' => false, 'error' => 'Error al eliminar la película.']);

            }

        } else {

            echo json_encode(['success' => false, 'error' => 'ID de película no recibido.']);

        }
    } else {

        echo json_encode(['success' => false, 'error' => 'Método de solicitud inválido.']);
        
    }

    $conn = null;
    exit();
?>