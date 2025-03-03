<?php

    include_once('../../conexion/conexion.php');

    try {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (isset($datos['id_actor'])) {

                $id_actor = $datos['id_actor'];

                // Iniciar la transacción
                $conn->beginTransaction();

                $eliminarRelacion = $conn->prepare("DELETE FROM actor_pelicula WHERE id_actor = :id_actor");
                $eliminarRelacion->bindParam(':id_actor', $id_actor);
                $eliminarRelacion->execute();

                $eliminarActor = $conn->prepare("DELETE FROM actores WHERE id_actor = :id_actor");
                $eliminarActor->bindParam(':id_actor', $id_actor);
                $eliminarActor->execute();

                // Confirmar los cambios
                $conn->commit();

                echo json_encode(['success' => true]);

                exit();

            } else {
                echo json_encode(['success' => false, 'error' => 'ID de actor no recibido.']);
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