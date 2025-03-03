<?php

    include_once('../../conexion/conexion.php');

    try {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (isset($datos['id_director'])) {

                $id_director = $datos['id_director'];

                // Iniciar la transacción
                $conn->beginTransaction();

                $eliminarRelacion = $conn->prepare("DELETE FROM director_pelicula WHERE id_director = :id_director");
                $eliminarRelacion->bindParam(':id_director', $id_director);
                $eliminarRelacion->execute();

                $eliminarDirector = $conn->prepare("DELETE FROM directores WHERE id_director = :id_director");
                $eliminarDirector->bindParam(':id_director', $id_director);
                $eliminarDirector->execute();

                // Confirmar los cambios
                $conn->commit();

                echo json_encode(['success' => true]);

                exit();

            } else {
                echo json_encode(['success' => false, 'error' => 'ID de director no recibido.']);
                exit();
            }

        } else {

            echo json_encode(['success' => false, 'error' => 'Método de solicitud inválido.']);
            exit();

        }

    } catch (Exception $e) {

        $conn->rollBack();
        echo json_encode(['success' => false, 'error' => 'Error al eliminar: ' . $e->getMessage()]);

    }

    $conn = null;
    exit();
?>