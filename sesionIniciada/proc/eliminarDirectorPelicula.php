<?php

    include_once('../../conexion/conexion.php');

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (isset($datos['id_director_pelicula'])) {

                $id_director_pelicula = $datos['id_director_pelicula'];

                $eliminarRelacion = $conn->prepare("DELETE FROM director_pelicula WHERE id_director_pelicula = :id_director_pelicula");
                $eliminarRelacion->bindParam(':id_director_pelicula', $id_director_pelicula);
                $eliminarRelacion->execute();

                echo json_encode(["success" => true]);

            } else {

                echo json_encode(['success' => false, 'error' => 'ID de relación no recibido.']);

            }

        } else {

            echo json_encode(['success' => false, 'error' => 'Método de solicitud inválido.']);
            exit();

        }

    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => "Error en el servidor: " . $e->getMessage()]);
    }
?>
